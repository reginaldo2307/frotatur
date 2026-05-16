<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Trip;
use App\Models\FinancialTransaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::withCount('trips')->get();
        
        $profitPerVehicle = $vehicles->map(function($vehicle) {
            $revenue = Trip::where('vehicle_id', $vehicle->id)->sum('price');
            $expenses = FinancialTransaction::where('description', 'LIKE', '%' . $vehicle->plate . '%')->sum('amount');
            return [
                'vehicle' => $vehicle->plate . ' - ' . $vehicle->model,
                'revenue' => $revenue,
                'expenses' => $expenses,
                'profit' => $revenue - $expenses,
                'trips_count' => $vehicle->trips_count
            ];
        });

        return view('reports.index', compact('profitPerVehicle'));
    }
}
