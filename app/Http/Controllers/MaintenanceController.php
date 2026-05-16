<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index()
    {
        $maintenances = Maintenance::with('vehicle')->latest()->paginate(10);
        return view('maintenances.index', compact('maintenances'));
    }

    public function create()
    {
        $vehicles = Vehicle::all();
        return view('maintenances.create', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'type' => 'required|string',
            'description' => 'required|string',
            'date' => 'required|date',
            'km_at_maintenance' => 'nullable|integer',
            'cost' => 'required|numeric',
            'provider' => 'nullable|string|max:255',
        ]);

        $maintenance = Maintenance::create($validated);

        // Atualizar status e KM do veículo
        $vehicle = Vehicle::find($request->vehicle_id);
        $vehicleUpdateData = ['status' => 'maintenance'];
        
        if ($request->km_at_maintenance && $request->km_at_maintenance > $vehicle->current_km) {
            $vehicleUpdateData['current_km'] = $request->km_at_maintenance;
        }
        
        $vehicle->update($vehicleUpdateData);

        // Criar transação financeira
        if ($request->cost > 0) {
            \App\Models\FinancialTransaction::create([
                'description' => "Manutenção: {$maintenance->description} ({$vehicle->plate})",
                'type' => 'expense',
                'amount' => $request->cost,
                'date' => $request->date,
                'category' => 'Manutenção',
                'maintenance_id' => $maintenance->id,
                'status' => 'paid',
                'paid_at' => now(),
            ]);
        }

        return redirect()->route('maintenances.index')->with('success', 'Manutenção registrada com sucesso!');
    }

    public function show(Maintenance $maintenance)
    {
        return view('maintenances.show', compact('maintenance'));
    }

    public function edit(Maintenance $maintenance)
    {
        $vehicles = Vehicle::all();
        return view('maintenances.edit', compact('maintenance', 'vehicles'));
    }

    public function update(Request $request, Maintenance $maintenance)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'type' => 'required|string',
            'description' => 'required|string',
            'date' => 'required|date',
            'km_at_maintenance' => 'nullable|integer',
            'cost' => 'required|numeric',
            'provider' => 'nullable|string|max:255',
        ]);

        $maintenance->update($validated);

        // Atualizar KM do veículo se necessário
        $vehicle = $maintenance->vehicle;
        if ($request->km_at_maintenance && $request->km_at_maintenance > $vehicle->current_km) {
            $vehicle->update(['current_km' => $request->km_at_maintenance]);
        }

        // Sincronizar transação financeira
        $transaction = $maintenance->transactions()->first();
        if ($request->cost > 0) {
            $transactionData = [
                'description' => "Manutenção: {$maintenance->description} ({$vehicle->plate})",
                'amount' => $request->cost,
                'date' => $request->date,
            ];

            if ($transaction) {
                $transaction->update($transactionData);
            } else {
                \App\Models\FinancialTransaction::create(array_merge($transactionData, [
                    'type' => 'expense',
                    'category' => 'Manutenção',
                    'maintenance_id' => $maintenance->id,
                    'status' => 'paid',
                    'paid_at' => now(),
                ]));
            }
        } elseif ($transaction) {
            $transaction->delete();
        }

        return redirect()->route('maintenances.index')->with('success', 'Manutenção atualizada!');
    }

    public function destroy(Maintenance $maintenance)
    {
        // Restaurar status do veículo se ele estava em manutenção
        $vehicle = $maintenance->vehicle;
        if ($vehicle->status === 'maintenance') {
            $vehicle->update(['status' => 'available']);
        }

        // Remover transação financeira associada
        $maintenance->transactions()->delete();

        $maintenance->delete();
        return redirect()->route('maintenances.index')->with('success', 'Registro excluído!');
    }
}
