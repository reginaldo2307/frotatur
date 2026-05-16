<x-app-layout>
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Logs de Auditoria</h1>
            <p class="text-slate-500 dark:text-slate-400">Rastreamento de ações e eventos do sistema.</p>
        </div>
    </div>

    <!-- Logs Table -->
    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 dark:bg-slate-800/50">
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase">Data/Hora</th>
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase">Usuário</th>
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase">Empresa</th>
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase">Ação / Evento</th>
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase">IP</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @forelse($logs as $log)
                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50">
                    <td class="px-6 py-4 text-sm text-slate-500">{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                    <td class="px-6 py-4 text-sm text-slate-700 dark:text-slate-200">{{ $log->user->name ?? 'Sistema' }}</td>
                    <td class="px-6 py-4 text-sm text-slate-700 dark:text-slate-200">{{ $log->company->name ?? 'Global' }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700">
                            {{ $log->action }}
                        </span>
                        @if($log->model_type)
                        <p class="text-xs text-slate-400 mt-1">{{ class_basename($log->model_type) }} #{{ $log->model_id }}</p>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-xs text-slate-500 font-mono">{{ $log->ip_address ?? 'N/A' }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-6 py-4 text-center text-sm text-slate-500">Nenhum log registrado ainda.</td></tr>
                @endforelse
            </tbody>
        </table>
        </div>
        <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-100 dark:border-slate-800">
            {{ $logs->links() }}
        </div>
    </div>
</div>
</x-app-layout>
