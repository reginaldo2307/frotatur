<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Services\VehicleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class VehicleController extends Controller
{
    public function __construct(
        protected VehicleService $service
    ) {}

    public function index()
    {
        $vehicles = $this->service->listVehicles();
        return view('vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        Gate::authorize('create', Vehicle::class);
        return view('vehicles.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('create', Vehicle::class);

        $validated = $request->validate([
            'plate' => 'required|string|max:10|unique:vehicles',
            'model' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'year' => 'required|integer',
            'capacity' => 'required|integer',
            'fuel_type' => 'required|string',
            'current_km' => 'required|integer',
            'color' => 'nullable|string|max:50',
        ]);

        $this->service->storeVehicle($validated);

        return redirect()->route('vehicles.index')->with('success', 'Veículo cadastrado com sucesso!');
    }

    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'model' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'year' => 'required|integer',
            'capacity' => 'required|integer',
            'fuel_type' => 'required|string',
            'current_km' => 'required|integer',
            'status' => 'required|string',
        ]);

        $this->service->updateVehicle($vehicle, $validated);

        return redirect()->route('vehicles.index')->with('success', 'Veículo atualizado!');
    }

    public function destroy(Vehicle $vehicle)
    {
        $this->service->removeVehicle($vehicle);
        return redirect()->route('vehicles.index')->with('success', 'Veículo removido!');
    }
}
