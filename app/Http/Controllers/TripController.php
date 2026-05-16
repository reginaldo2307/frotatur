<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Vehicle;
use App\Models\Driver;
use App\Models\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class TripController extends Controller
{
    public function downloadOs(Trip $trip)
    {
        $pdf = Pdf::loadView('reports.pdf.order_of_service', compact('trip'));
        return $pdf->download("os-viagem-{$trip->id}.pdf");
    }
    public function index()
    {
        $trips = Trip::with(['vehicle', 'driver', 'customer'])->latest()->paginate(10);
        return view('trips.index', compact('trips'));
    }

    public function create()
    {
        $vehicles = Vehicle::all();
        $drivers = Driver::where('active', true)->get();
        $customers = Customer::all();
        return view('trips.create', compact('vehicles', 'drivers', 'customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'required|exists:drivers,id',
            'customer_id' => 'nullable|exists:customers,id',
            'passenger_count' => 'required|integer|min:1',
            'origin' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'departure_time' => 'required|date',
            'return_time' => 'nullable|date|after:departure_time',
            'price' => 'nullable|numeric',
            'start_km' => 'nullable|integer',
            'notes' => 'nullable|string',
        ]);

        // Validar Conflitos
        if ($this->hasConflicts($request)) {
            return back()->withInput()->withErrors(['conflict' => 'Conflito de agendamento: Veículo ou Motorista já ocupado neste horário.']);
        }

        $validated['company_id'] = auth()->user()->company_id;
        $trip = Trip::create($validated);

        // Criar transação financeira se houver valor
        if ($trip->price > 0) {
            \App\Models\FinancialTransaction::create([
                'description' => "Viagem #{$trip->id}: {$trip->origin} -> {$trip->destination}",
                'type' => 'revenue',
                'amount' => $trip->price,
                'date' => $trip->departure_time->format('Y-m-d'),
                'category' => 'Viagens',
                'trip_id' => $trip->id,
                'status' => 'pending', // Geralmente recebimento é posterior
            ]);
        }

        return redirect()->route('trips.index')->with('success', 'Viagem agendada com sucesso!');
    }

    private function hasConflicts(Request $request, $excludeId = null)
    {
        $start = Carbon::parse($request->departure_time);
        $end = $request->return_time ? Carbon::parse($request->return_time) : $start->copy()->addHours(4);

        $query = Trip::whereNotIn('status', ['cancelled', 'completed']);


        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        // Verifica veículo ou motorista
        $query->where(function ($q) use ($request) {
            $q->where('vehicle_id', $request->vehicle_id)
              ->orWhere('driver_id', $request->driver_id);
        });

        // Lógica de sobreposição: (A_inicio < B_fim) AND (A_fim > B_inicio)
        $query->where(function ($q) use ($start, $end) {
            $q->where(function ($sq) use ($start, $end) {
                // Caso B tenha data de retorno
                $sq->whereNotNull('return_time')
                   ->where('departure_time', '<', $end)
                   ->where('return_time', '>', $start);
            })->orWhere(function ($sq) use ($start) {
                // Caso B NÃO tenha data de retorno (consideramos ocupado a partir da partida)
                $sq->whereNull('return_time')
                   ->where('departure_time', '<=', $start);
            });
        });

        return $query->exists();
    }

    public function edit(Trip $trip)
    {
        $vehicles = Vehicle::all();
        $drivers = Driver::all();
        $customers = Customer::all();
        return view('trips.edit', compact('trip', 'vehicles', 'drivers', 'customers'));
    }

    public function update(Request $request, Trip $trip)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'required|exists:drivers,id',
            'customer_id' => 'nullable|exists:customers,id',
            'passenger_count' => 'required|integer|min:1',
            'origin' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'departure_time' => 'required|date',
            'return_time' => 'nullable|date|after:departure_time',
            'price' => 'nullable|numeric',
            'start_km' => 'nullable|integer',
            'end_km' => 'nullable|integer',
            'status' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $oldStatus = $trip->status;
        $trip->update($validated);

        // Se a viagem foi concluída agora, atualizar o veículo
        if ($validated['status'] === 'completed' && $oldStatus !== 'completed') {
            $vehicle = $trip->vehicle;
            if ($vehicle) {
                $vehicleUpdateData = ['status' => 'available'];
                
                if ($request->end_km && $request->end_km > $vehicle->current_km) {
                    $vehicleUpdateData['current_km'] = $request->end_km;
                }
                
                $vehicle->update($vehicleUpdateData);
            }
        }

        // Se a viagem está em curso, marcar veículo como ocupado
        if ($validated['status'] === 'in_progress' && $trip->vehicle) {
            $trip->vehicle->update(['status' => 'busy']);
        }

        // Se a viagem foi cancelada ou voltou para agendada, liberar veículo (se ele não estiver em manutenção)
        if (($validated['status'] === 'cancelled' || $validated['status'] === 'scheduled') && $oldStatus === 'in_progress') {
            if ($trip->vehicle && $trip->vehicle->status === 'busy') {
                $trip->vehicle->update(['status' => 'available']);
            }
        }

        // Sincronizar transação financeira
        $transaction = $trip->transactions()->where('type', 'revenue')->first();
        if ($trip->price > 0) {
            $transactionData = [
                'description' => "Viagem #{$trip->id}: {$trip->origin} -> {$trip->destination}",
                'amount' => $trip->price,
                'date' => $trip->departure_time->format('Y-m-d'),
            ];

            if ($transaction) {
                $transaction->update($transactionData);
            } else {
                \App\Models\FinancialTransaction::create(array_merge($transactionData, [
                    'type' => 'revenue',
                    'category' => 'Viagens',
                    'trip_id' => $trip->id,
                    'status' => 'pending',
                ]));
            }
        } elseif ($transaction) {
            $transaction->delete();
        }

        return redirect()->route('trips.index')->with('success', 'Viagem atualizada com sucesso!');
    }

    public function destroy(Trip $trip)
    {
        $trip->delete();
        return redirect()->route('trips.index')->with('success', 'Viagem excluída com sucesso!');
    }
}
