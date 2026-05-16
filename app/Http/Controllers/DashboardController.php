<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Trip;
use App\Models\Maintenance;
use App\Models\FinancialTransaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('Super Admin')) {
            return app(\App\Http\Controllers\SuperAdmin\DashboardController::class)->index();
        }

        $today = Carbon::today();
        $startOfMonth = Carbon::now()->startOfMonth();

        $totalVehicles = Vehicle::count();
        $tripsToday = Trip::whereDate('departure_time', $today)->count();
        
        $monthlyRevenue = FinancialTransaction::where('type', 'revenue')
            ->where('status', 'paid')
            ->where('date', '>=', $startOfMonth)
            ->sum('amount');

        $alertsCount = Vehicle::where('insurance_expiry', '<', Carbon::now()->addDays(15))->count() +
                      Maintenance::where('date', '<', Carbon::now())->count();

        $upcomingTrips = Trip::with(['vehicle', 'driver'])
            ->where('departure_time', '>=', Carbon::now())
            ->where('status', 'scheduled')
            ->orderBy('departure_time', 'asc')
            ->take(5)
            ->get();

        // Fluxo Financeiro - Últimos 7 dias
        $financialChartLabels = [];
        $financialChartData = [];
        $diasSemana = [
            'Sun' => 'Dom', 'Mon' => 'Seg', 'Tue' => 'Ter', 'Wed' => 'Qua',
            'Thu' => 'Qui', 'Fri' => 'Sex', 'Sat' => 'Sáb'
        ];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $financialChartLabels[] = $diasSemana[$date->format('D')];
            
            $dailyRevenue = FinancialTransaction::where('type', 'revenue')
                ->where('status', 'paid')
                ->whereDate('date', $date)
                ->sum('amount');
                
            $financialChartData[] = $dailyRevenue;
        }

        return view('dashboard', compact(
            'totalVehicles', 
            'tripsToday', 
            'monthlyRevenue', 
            'alertsCount',
            'upcomingTrips',
            'financialChartLabels',
            'financialChartData'
        ));
    }
}
