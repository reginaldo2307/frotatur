<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_companies' => \App\Models\Company::count(),
            'active_companies' => \App\Models\Company::where('active', true)->count(),
            'total_users' => \App\Models\User::count(),
            'total_vehicles' => \App\Models\Vehicle::count(),
            'total_trips' => \App\Models\Trip::count(),
            'mrr' => \App\Models\Payment::where('status', 'completed')
                ->whereMonth('created_at', now()->month)
                ->sum('amount'),
            'arr' => \App\Models\Payment::where('status', 'completed')
                ->whereYear('created_at', now()->year)
                ->sum('amount'),
        ];

        // Dados reais para o gráfico (últimos 6 meses)
        $growthData = \App\Models\Company::select(
                DB::raw('count(*) as count'), 
                DB::raw('MONTH(created_at) as month')
            )
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        // Atividades recentes (Log de auditoria ou empresas criadas)
        $recentActivities = \App\Models\AuditLog::with('user', 'company')
            ->latest()
            ->limit(5)
            ->get();
        
        // Se não houver logs, pega as últimas empresas como fallback
        if ($recentActivities->isEmpty()) {
            $recentActivities = \App\Models\Company::latest()->limit(5)->get()->map(function($company) {
                return (object) [
                    'action' => 'Nova Empresa Cadastrada',
                    'description' => $company->name . ' se juntou à plataforma.',
                    'created_at' => $company->created_at
                ];
            });
        }

        return view('superadmin.dashboard', compact('stats', 'growthData', 'recentActivities'));

    }
}

