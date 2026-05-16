<?php

namespace App\Http\Controllers;

use App\Models\FinancialTransaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FinancialTransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = FinancialTransaction::query();

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $transactions = $query->latest()->paginate(10);
        
        $totalRevenue = FinancialTransaction::where('type', 'revenue')->where('status', 'paid')->sum('amount');
        $totalExpense = FinancialTransaction::where('type', 'expense')->where('status', 'paid')->sum('amount');
        $pendingPayable = FinancialTransaction::where('type', 'expense')->where('status', 'pending')->sum('amount');
        $pendingReceivable = FinancialTransaction::where('type', 'revenue')->where('status', 'pending')->sum('amount');

        return view('finance.index', compact('transactions', 'totalRevenue', 'totalExpense', 'pendingPayable', 'pendingReceivable'));
    }

    public function create()
    {
        return view('finance.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'type' => 'required|in:revenue,expense',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'due_date' => 'nullable|date',
            'status' => 'required|in:pending,paid',
            'category' => 'nullable|string',
        ]);

        if ($validated['status'] == 'paid' && !isset($validated['paid_at'])) {
            $validated['paid_at'] = Carbon::now();
        }

        $validated['company_id'] = auth()->user()->company_id;
        FinancialTransaction::create($validated);

        return redirect()->route('finance.index')->with('success', 'Lançamento realizado com sucesso!');
    }

    public function show(FinancialTransaction $finance)
    {
        return redirect()->route('finance.index');
    }

    public function edit(FinancialTransaction $finance)
    {
        return view('finance.edit', compact('finance'));
    }

    public function update(Request $request, FinancialTransaction $finance)
    {
        // Se vier apenas confirmação de pagamento (botão "Confirmar" da listagem)
        if ($request->has('_confirm_payment') || (!$request->has('description') && !$request->has('amount'))) {
            $finance->update([
                'status' => 'paid',
                'paid_at' => Carbon::now()
            ]);
            return back()->with('success', 'Pagamento/Recebimento confirmado!');
        }

        // Caso contrário, é uma edição completa
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'type'        => 'required|in:revenue,expense',
            'amount'      => 'required|numeric',
            'date'        => 'required|date',
            'due_date'    => 'nullable|date',
            'status'      => 'required|in:pending,paid',
            'category'    => 'nullable|string',
        ]);

        if ($validated['status'] == 'paid' && !$finance->paid_at) {
            $validated['paid_at'] = Carbon::now();
        }

        $finance->update($validated);

        return redirect()->route('finance.index')->with('success', 'Lançamento atualizado com sucesso!');
    }

    public function destroy(FinancialTransaction $finance)
    {
        $finance->delete();
        return redirect()->route('finance.index')->with('success', 'Lançamento excluído!');
    }
}
