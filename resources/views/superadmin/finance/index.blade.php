<x-app-layout>
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Financeiro Global (SaaS)</h1>
            <p class="text-slate-500 dark:text-slate-400">Gerencie pagamentos e assinaturas das empresas.</p>
        </div>
    </div>

    <!-- Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Receita Total</p>
            <h3 class="text-2xl font-bold text-slate-800 dark:text-white mt-1">R$ {{ number_format($metrics['total_revenue'], 2, ',', '.') }}</h3>
        </div>
        <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm">
            <p class="text-sm font-medium text-slate-500">MRR (Mês Atual)</p>
            <h3 class="text-2xl font-bold text-slate-800 dark:text-white mt-1">R$ {{ number_format($metrics['mrr'], 2, ',', '.') }}</h3>
        </div>
        <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Inadimplência / Pendente</p>
            <h3 class="text-2xl font-bold text-slate-800 dark:text-white mt-1">R$ {{ number_format($metrics['pending_revenue'], 2, ',', '.') }}</h3>
        </div>
    </div>

    <!-- Payments Table -->
    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 dark:bg-slate-800/50">
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase">Empresa</th>
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase">Valor</th>
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase">Status</th>
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase">Método</th>
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase">Data</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @forelse($payments as $payment)
                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50">
                    <td class="px-6 py-4">
                        <p class="text-sm font-semibold text-slate-700 dark:text-slate-200">{{ $payment->company->name ?? 'N/A' }}</p>
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-slate-700 dark:text-slate-200">
                        R$ {{ number_format($payment->amount, 2, ',', '.') }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $payment->status == 'completed' ? 'bg-emerald-100 text-emerald-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ ucfirst($payment->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-500">{{ strtoupper($payment->payment_method ?? 'N/A') }}</td>
                    <td class="px-6 py-4 text-sm text-slate-500">{{ $payment->created_at->format('d/m/Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-6 py-4 text-center text-sm text-slate-500">Nenhum pagamento registrado.</td></tr>
                @endforelse
            </tbody>
        </table>
        </div>
        <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-100 dark:border-slate-800">
            {{ $payments->links() }}
        </div>
    </div>
</div>
</x-app-layout>
