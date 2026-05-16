<x-app-layout>
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Empresas Cadastradas</h1>
            <p class="text-slate-500 dark:text-slate-400">Gerencie todos os clientes da plataforma.</p>
        </div>
        <a href="{{ route('admin.companies.create') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-medium transition-colors shadow-sm">
            Nova Empresa
        </a>
    </div>

    <!-- Filters -->
    <div class="flex flex-wrap items-center gap-4 bg-white dark:bg-slate-900 p-4 rounded-xl border border-slate-100 dark:border-slate-800 shadow-sm">
        <div class="flex-1 min-w-[200px]">
            <input type="text" placeholder="Filtrar por nome ou CNPJ..." class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-lg text-sm focus:ring-2 focus:ring-indigo-500">
        </div>
        <select class="bg-slate-50 dark:bg-slate-800 border-none rounded-lg text-sm text-slate-600 focus:ring-2 focus:ring-indigo-500">
            <option>Todos os Planos</option>
            <option>Básico</option>
            <option>Profissional</option>
        </select>
        <select class="bg-slate-50 dark:bg-slate-800 border-none rounded-lg text-sm text-slate-600 focus:ring-2 focus:ring-indigo-500">
            <option>Status: Todos</option>
            <option>Ativas</option>
            <option>Suspensas</option>
        </select>
    </div>

    <!-- Table -->
    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 dark:bg-slate-800/50">
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Empresa</th>
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Plano</th>
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Uso (V/U)</th>
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider text-right">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @foreach($companies as $company)
                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-indigo-50 dark:bg-indigo-900/20 flex items-center justify-center text-indigo-600 font-bold">
                                {{ substr($company->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-slate-700 dark:text-slate-200">{{ $company->name }}</p>
                                <p class="text-xs text-slate-500">{{ $company->email ?? 'Sem e-mail' }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 border border-slate-200 dark:border-slate-700">
                            {{ $company->plan->name ?? 'Sem Plano' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="flex items-center gap-1.5 text-xs font-medium {{ $company->active ? 'text-emerald-600' : 'text-red-600' }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $company->active ? 'bg-emerald-500' : 'bg-red-500' }}"></span>
                            {{ $company->active ? 'Ativa' : 'Suspensa' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-sm text-slate-600 dark:text-slate-400">
                            <span class="font-medium text-slate-800 dark:text-slate-200">{{ $company->vehicles()->count() }}</span>/{{ $company->plan->max_vehicles ?? '∞' }} V
                        </p>
                        <p class="text-xs text-slate-400">
                            {{ $company->users()->count() }} Usuários
                        </p>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.companies.show', $company->id) }}" class="p-2 text-slate-400 hover:text-indigo-600 transition-colors" title="Acessar conta">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                            </a>
                            <a href="{{ route('admin.companies.edit', $company->id) }}" class="p-2 text-slate-400 hover:text-slate-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-100 dark:border-slate-800">
            {{ $companies->links() }}
        </div>
    </div>
</div>
</x-app-layout>
