<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = \App\Models\Company::with('plan')->latest()->paginate(10);
        return view('superadmin.companies.index', compact('companies'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $plans = \App\Models\Plan::all();
        return view('superadmin.companies.create', compact('plans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'document' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'plan_id' => 'required|exists:plans,id',
            'subscription_status' => 'required|string',
        ]);

        $company = \App\Models\Company::create($validated);

        if ($request->filled('admin_name') && $request->filled('admin_email') && $request->filled('admin_password')) {
            $user = \App\Models\User::create([
                'name' => $request->admin_name,
                'email' => $request->admin_email,
                'password' => \Illuminate\Support\Facades\Hash::make($request->admin_password),
                'company_id' => $company->id,
            ]);
            
            $role = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'Company Admin']);
            $user->assignRole($role);
        }

        return redirect()->route('admin.companies.index')->with('success', 'Empresa cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
