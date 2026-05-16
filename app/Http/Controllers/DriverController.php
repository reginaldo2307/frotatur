<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::latest()->paginate(10);
        return view('drivers.index', compact('drivers'));
    }

    public function create()
    {
        return view('drivers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'cpf' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'license_number' => 'required|string|max:20',
            'license_category' => 'required|string|max:5',
            'license_expiry' => 'required|date',
        ]);

        $validated['company_id'] = auth()->user()->company_id;
        Driver::create($validated);

        return redirect()->route('drivers.index')->with('success', 'Motorista cadastrado com sucesso!');
    }

    public function edit(Driver $driver)
    {
        return view('drivers.edit', compact('driver'));
    }

    public function update(Request $request, Driver $driver)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'cpf' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'license_number' => 'required|string|max:20',
            'license_category' => 'required|string|max:5',
            'license_expiry' => 'required|date',
            'active' => 'required|boolean',
        ]);

        $driver->update($validated);

        return redirect()->route('drivers.index')->with('success', 'Motorista atualizado com sucesso!');
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();
        return redirect()->route('drivers.index')->with('success', 'Motorista excluído com sucesso!');
    }
}
