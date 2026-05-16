<x-app-layout>
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Tickets de Suporte</h1>
            <p class="text-slate-500 dark:text-slate-400">Atenda os clientes da plataforma SaaS.</p>
        </div>
    </div>

    <!-- Tickets Table -->
    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 dark:bg-slate-800/50">
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase">Ticket</th>
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase">Empresa / Usuário</th>
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase">Prioridade</th>
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase">Status</th>
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase">Criado em</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @forelse($tickets as $ticket)
                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50">
                    <td class="px-6 py-4">
                        <p class="text-sm font-semibold text-slate-700 dark:text-slate-200">#{{ $ticket->id }} - {{ $ticket->subject }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-sm text-slate-700 dark:text-slate-200">{{ $ticket->company->name ?? 'N/A' }}</p>
                        <p class="text-xs text-slate-500">{{ $ticket->user->name ?? 'N/A' }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-700">
                            {{ ucfirst($ticket->priority) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $ticket->status == 'open' ? 'bg-red-100 text-red-700' : 'bg-emerald-100 text-emerald-700' }}">
                            {{ ucfirst($ticket->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-500">{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-6 py-4 text-center text-sm text-slate-500">Nenhum ticket aberto.</td></tr>
                @endforelse
            </tbody>
        </table>
        </div>
        <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-100 dark:border-slate-800">
            {{ $tickets->links() }}
        </div>
    </div>
</div>
</x-app-layout>
