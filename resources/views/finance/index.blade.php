<x-app-layout>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Controle Financeiro Avançado</h2>
        <a href="{{ route('finance.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200 flex items-center shadow-sm">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Novo Lançamento
        </a>
    </div>

    <!-- Cards de Resumo -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-green-500">
            <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Receitas (Pagas)</p>
            <p class="text-xl font-bold text-green-600">R$ {{ number_format($totalRevenue, 2, ',', '.') }}</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-red-500">
            <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Despesas (Pagas)</p>
            <p class="text-xl font-bold text-red-600">R$ {{ number_format($totalExpense, 2, ',', '.') }}</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-orange-400">
            <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">A Pagar (Pendente)</p>
            <p class="text-xl font-bold text-orange-600">R$ {{ number_format($pendingPayable, 2, ',', '.') }}</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-blue-400">
            <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">A Receber (Pendente)</p>
            <p class="text-xl font-bold text-blue-600">R$ {{ number_format($pendingReceivable, 2, ',', '.') }}</p>
        </div>
    </div>

    <div class="bg-white shadow-sm rounded-xl overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data / Venc.</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descrição</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Valor</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($transactions as $transaction)
                <tr class="hover:bg-gray-50 transition-colors duration-150">
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <div class="text-gray-900">{{ \Carbon\Carbon::parse($transaction->date)->format('d/m/Y') }}</div>
                        @if($transaction->due_date)
                        <div class="text-xs text-red-500">Venc: {{ \Carbon\Carbon::parse($transaction->due_date)->format('d/m/Y') }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $transaction->description }}</div>
                        <div class="text-xs text-gray-500">{{ $transaction->category ?: 'Geral' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm font-bold {{ $transaction->type == 'revenue' ? 'text-green-600' : 'text-red-600' }}">
                            {{ $transaction->type == 'revenue' ? '+' : '-' }} R$ {{ number_format($transaction->amount, 2, ',', '.') }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($transaction->status == 'paid')
                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Efetuado
                        </span>
                        @else
                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            Pendente
                        </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex justify-end space-x-2">
                            @if($transaction->status == 'pending')
                            <form action="{{ route('finance.update', $transaction) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="_confirm_payment" value="1">
                                <button type="submit" class="text-green-600 hover:text-green-900 bg-green-50 p-2 rounded-lg" title="Confirmar Pagamento">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </button>
                            </form>
                            @endif
                            <a href="{{ route('finance.edit', $transaction) }}" class="text-blue-600 hover:text-blue-900 bg-blue-50 p-2 rounded-lg" title="Editar">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <form action="{{ route('finance.destroy', $transaction) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 p-2 rounded-lg" title="Excluir" onclick="return confirm('Excluir este lançamento?')">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                        Nenhum lançamento encontrado.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>
</x-app-layout>
