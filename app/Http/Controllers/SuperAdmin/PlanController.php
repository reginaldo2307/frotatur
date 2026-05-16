<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        $plans = \App\Models\Plan::all();
        return view('superadmin.plans.index', compact('plans'));
    }

    public function create()
    {
        return view('superadmin.plans.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:plans',
            'price' => 'required|numeric',
            'max_vehicles' => 'nullable|integer',
            'max_users' => 'nullable|integer',
            'max_trips_monthly' => 'nullable|integer',
        ]);

        \App\Models\Plan::create($validated);

        return redirect()->route('admin.plans.index')->with('success', 'Plano criado com sucesso!');
    }
}

