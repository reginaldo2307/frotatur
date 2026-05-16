<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function index()
    {
        $payments = \App\Models\Payment::with(['company', 'subscription'])->latest()->paginate(20);
        
        $metrics = [
            'total_revenue' => \App\Models\Payment::where('status', 'completed')->sum('amount'),
            'pending_revenue' => \App\Models\Payment::where('status', 'pending')->sum('amount'),
            'mrr' => \App\Models\Payment::where('status', 'completed')->whereMonth('created_at', now()->month)->sum('amount'),
        ];
        
        return view('superadmin.finance.index', compact('payments', 'metrics'));
    }
}
