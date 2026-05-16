<x-app-layout>
<div class="space-y-8 max-w-4xl mx-auto">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.companies.index') }}" class="p-2 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-lg text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Nova Empresa</h1>
            <p class="text-slate-500 dark:text-slate-400">Cadastre um novo cliente (empresa) na plataforma.</p>
        </div>
    </div>

    <form action="{{ route('admin.companies.store') }}" method="POST" class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm overflow-hidden">
        @csrf
        <div class="p-8 space-y-6">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nome da Empresa -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-200">Nome Fantasia / Razão Social <span class="text-red-500">*</span></label>
                    <input type="text" name="name" required placeholder="Ex: Viação Progresso" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                </div>

                <!-- Documento (CNPJ/CPF) -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-200">CNPJ / CPF <span class="text-red-500">*</span></label>
                    <input type="text" name="document" required placeholder="00.000.000/0001-00" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                </div>

                <!-- E-mail de Contato -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-200">E-mail Principal <span class="text-red-500">*</span></label>
                    <input type="email" name="email" required placeholder="contato@empresa.com" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                </div>

                <!-- Telefone -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-200">Telefone / WhatsApp</label>
                    <input type="text" name="phone" placeholder="(00) 00000-0000" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                </div>
            </div>

            <hr class="border-slate-100 dark:border-slate-800">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Plano -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-200">Plano de Assinatura <span class="text-red-500">*</span></label>
                    <select name="plan_id" required class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                        <option value="">Selecione um plano...</option>
                        @foreach($plans as $plan)
                            <option value="{{ $plan->id }}">{{ $plan->name }} (R$ {{ number_format($plan->price, 2, ',', '.') }})</option>
                        @endforeach
                    </select>
                </div>

                <!-- Status da Assinatura -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-200">Status Inicial</label>
                    <select name="subscription_status" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                        <option value="active">Ativo (Pagamento Confirmado / Trial)</option>
                        <option value="pending">Pendente de Pagamento</option>
                        <option value="suspended">Suspenso</option>
                    </select>
                </div>
            </div>

            <!-- Dados do Usuário Administrador (Opcional criar junto) -->
            <div class="bg-indigo-50 dark:bg-indigo-900/10 border border-indigo-100 dark:border-indigo-900/30 p-6 rounded-xl mt-6">
                <h3 class="text-sm font-bold text-indigo-800 dark:text-indigo-300 mb-4 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Criar Usuário Administrador da Empresa
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" name="admin_name" placeholder="Nome do Administrador" class="w-full bg-white dark:bg-slate-800 border border-indigo-200 dark:border-indigo-800/50 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-indigo-500 outline-none">
                    <input type="email" name="admin_email" placeholder="E-mail de acesso" class="w-full bg-white dark:bg-slate-800 border border-indigo-200 dark:border-indigo-800/50 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-indigo-500 outline-none">
                    <div class="md:col-span-2">
                        <input type="password" name="admin_password" placeholder="Senha provisória" class="w-full bg-white dark:bg-slate-800 border border-indigo-200 dark:border-indigo-800/50 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-indigo-500 outline-none">
                    </div>
                </div>
                <p class="text-xs text-indigo-600 dark:text-indigo-400 mt-3">Deixe em branco se não quiser criar o usuário administrador agora.</p>
            </div>

        </div>
        
        <div class="px-8 py-4 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-100 dark:border-slate-800 flex justify-end gap-3">
            <a href="{{ route('admin.companies.index') }}" class="px-5 py-2.5 text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 rounded-lg transition-colors">Cancelar</a>
            <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg transition-colors shadow-sm shadow-indigo-200">Cadastrar Empresa</button>
        </div>
    </form>
</div>
</x-app-layout>
