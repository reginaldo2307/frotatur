<x-app-layout>
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Planos de Assinatura</h1>
            <p class="text-slate-500 dark:text-slate-400">Configure os pacotes e limites do SaaS.</p>
        </div>
        <button class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-medium transition-colors shadow-sm">
            Criar Novo Plano
        </button>
    </div>

    <!-- Plans Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach($plans as $plan)
        <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-100 dark:border-slate-800 shadow-sm overflow-hidden flex flex-col">
            <div class="p-8 border-b border-slate-50 dark:border-slate-800/50">
                <div class="flex justify-between items-start mb-4">
                    <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400">
                        {{ $plan->slug }}
                    </span>
                    <button class="text-slate-400 hover:text-slate-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/></svg>
                    </button>
                </div>
                <h3 class="text-xl font-bold text-slate-800 dark:text-white">{{ $plan->name }}</h3>
                <p class="mt-4">
                    <span class="text-4xl font-extrabold text-slate-900 dark:text-white">R$ {{ number_format($plan->price, 2, ',', '.') }}</span>
                    <span class="text-slate-500">/mês</span>
                </p>
            </div>
            
            <div class="p-8 flex-1 bg-slate-50/50 dark:bg-slate-950/20">
                <ul class="space-y-4">
                    <li class="flex items-center gap-3 text-sm text-slate-600 dark:text-slate-400">
                        <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Até <strong>{{ $plan->max_vehicles }}</strong> veículos
                    </li>
                    <li class="flex items-center gap-3 text-sm text-slate-600 dark:text-slate-400">
                        <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Até <strong>{{ $plan->max_users }}</strong> usuários
                    </li>
                    <li class="flex items-center gap-3 text-sm text-slate-600 dark:text-slate-400">
                        <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <strong>{{ $plan->max_trips_monthly }}</strong> viagens mensais
                    </li>
                    <li class="flex items-center gap-3 text-sm text-slate-600 dark:text-slate-400">
                        <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Suporte prioritário
                    </li>
                </ul>
            </div>

            <div class="p-6 bg-white dark:bg-slate-900 border-t border-slate-100 dark:border-slate-800">
                <button class="w-full py-2.5 border border-slate-200 dark:border-slate-700 rounded-xl text-sm font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                    Editar Plano
                </button>
            </div>
        </div>
        @endforeach
    </div>
</div>
</x-app-layout>
