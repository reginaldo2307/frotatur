<x-app-layout>
<div class="space-y-8 max-w-4xl mx-auto">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.plans.index') }}" class="p-2 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-lg text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Novo Plano</h1>
            <p class="text-slate-500 dark:text-slate-400">Crie um novo pacote de assinatura para a plataforma.</p>
        </div>
    </div>

    <form action="{{ route('admin.plans.store') }}" method="POST" class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm overflow-hidden">
        @csrf
        <div class="p-8 space-y-6">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nome do Plano -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-200">Nome do Plano <span class="text-red-500">*</span></label>
                    <input type="text" name="name" required placeholder="Ex: Starter, Pro, Enterprise" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                </div>

                <!-- Slug -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-200">Slug (Identificador) <span class="text-red-500">*</span></label>
                    <input type="text" name="slug" required placeholder="Ex: plano-pro" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                    <p class="text-[10px] text-slate-400">Usado em URLs e integrações de pagamento.</p>
                </div>

                <!-- Preço -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-200">Preço Mensal (R$) <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <span class="absolute left-4 top-2.5 text-slate-500 font-medium">R$</span>
                        <input type="number" step="0.01" name="price" required placeholder="99.90" class="w-full pl-10 pr-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                    </div>
                </div>
            </div>

            <hr class="border-slate-100 dark:border-slate-800">
            <h3 class="text-sm font-bold text-slate-800 dark:text-slate-200">Limites do Plano</h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Limite de Veículos -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-200">Máx. Veículos</label>
                    <input type="number" name="max_vehicles" placeholder="Ex: 50" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                    <p class="text-[10px] text-slate-400">Deixe em branco para ilimitado.</p>
                </div>

                <!-- Limite de Usuários -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-200">Máx. Usuários</label>
                    <input type="number" name="max_users" placeholder="Ex: 10" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                    <p class="text-[10px] text-slate-400">Deixe em branco para ilimitado.</p>
                </div>

                <!-- Limite de Viagens -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-200">Máx. Viagens/mês</label>
                    <input type="number" name="max_trips_monthly" placeholder="Ex: 1000" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                    <p class="text-[10px] text-slate-400">Deixe em branco para ilimitado.</p>
                </div>
            </div>

        </div>
        
        <div class="px-8 py-4 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-100 dark:border-slate-800 flex justify-end gap-3">
            <a href="{{ route('admin.plans.index') }}" class="px-5 py-2.5 text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 rounded-lg transition-colors">Cancelar</a>
            <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg transition-colors shadow-sm shadow-indigo-200">Criar Plano</button>
        </div>
    </form>
</div>
</x-app-layout>
