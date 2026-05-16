<div :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-slate-900 lg:translate-x-0 lg:static lg:inset-0 border-r border-slate-800">
    <div class="flex items-center justify-center mt-8">
        <div class="flex items-center">
            <svg class="w-10 h-10 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
            <span class="mx-2 text-2xl font-bold text-white font-heading tracking-tight">Frota<span class="text-blue-500">Tur</span></span>
        </div>
    </div>

    <nav class="mt-10 px-4">
        <div>
            <p class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-widest mb-2">Principal</p>
            <a class="flex items-center py-2.5 px-4 rounded-xl transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}" href="{{ route('dashboard') }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                <span class="mx-3 font-medium text-sm">Dashboard</span>
            </a>
        </div>

        @hasrole('Super Admin')
        <div class="mt-6">
            <p class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-widest mb-2">Gestão SaaS</p>
            <a class="flex items-center py-2.5 px-4 rounded-xl mb-1 transition-all duration-200 {{ request()->routeIs('admin.companies.*') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}" href="{{ route('admin.companies.index') }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                <span class="mx-3 font-medium text-sm">Empresas</span>
            </a>
            <a class="flex items-center py-2.5 px-4 rounded-xl mb-1 transition-all duration-200 {{ request()->routeIs('admin.plans.*') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}" href="{{ route('admin.plans.index') }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                <span class="mx-3 font-medium text-sm">Planos & Preços</span>
            </a>
            <a class="flex items-center py-2.5 px-4 rounded-xl mb-1 transition-all duration-200 {{ request()->routeIs('admin.finance.*') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}" href="{{ route('admin.finance.index') }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M12 13V12"/></svg>
                <span class="mx-3 font-medium text-sm">Financeiro Global</span>
            </a>
            <a class="flex items-center py-2.5 px-4 rounded-xl mb-1 transition-all duration-200 {{ request()->routeIs('admin.tickets.*') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}" href="{{ route('admin.tickets.index') }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                <span class="mx-3 font-medium text-sm">Suporte (Tickets)</span>
            </a>
            <a class="flex items-center py-2.5 px-4 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.logs.*') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}" href="{{ route('admin.logs.index') }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                <span class="mx-3 font-medium text-sm">Logs de Auditoria</span>
            </a>
        </div>
        @else
        <div class="mt-6">
            <p class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-widest mb-2">Frota e Equipe</p>
            <a class="flex items-center py-2.5 px-4 rounded-xl mb-1 transition-all duration-200 {{ request()->routeIs('vehicles.*') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}" href="{{ route('vehicles.index') }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" /></svg>
                <span class="mx-3 font-medium text-sm">Veículos</span>
            </a>
            <a class="flex items-center py-2.5 px-4 rounded-xl mb-1 transition-all duration-200 {{ request()->routeIs('drivers.*') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}" href="{{ route('drivers.index') }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                <span class="mx-3 font-medium text-sm">Motoristas</span>
            </a>
            <a class="flex items-center py-2.5 px-4 rounded-xl transition-all duration-200 {{ request()->routeIs('customers.*') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}" href="{{ route('customers.index') }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                <span class="mx-3 font-medium text-sm">Clientes</span>
            </a>
        </div>

        <div class="mt-6">
            <p class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-widest mb-2">Operacional</p>
            <a class="flex items-center py-2.5 px-4 rounded-xl mb-1 transition-all duration-200 {{ request()->routeIs('calendar.*') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}" href="{{ route('calendar.index') }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                <span class="mx-3 font-medium text-sm">Agenda</span>
            </a>
            <a class="flex items-center py-2.5 px-4 rounded-xl transition-all duration-200 {{ request()->routeIs('trips.*') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}" href="{{ route('trips.index') }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>
                <span class="mx-3 font-medium text-sm">Viagens</span>
            </a>
        </div>

        <div class="mt-6">
            <p class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-widest mb-2">Administrativo</p>
            <a class="flex items-center py-2.5 px-4 rounded-xl mb-1 transition-all duration-200 {{ request()->routeIs('finance.*') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}" href="{{ route('finance.index') }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span class="mx-3 font-medium text-sm">Financeiro</span>
            </a>
            <a class="flex items-center py-2.5 px-4 rounded-xl mb-1 transition-all duration-200 {{ request()->routeIs('maintenances.*') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}" href="{{ route('maintenances.index') }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                <span class="mx-3 font-medium text-sm">Manutenção</span>
            </a>
            <a class="flex items-center py-2.5 px-4 rounded-xl mb-1 transition-all duration-200 {{ request()->routeIs('documents.*') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}" href="{{ route('documents.index') }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                <span class="mx-3 font-medium text-sm">Documentos</span>
            </a>
            <a class="flex items-center py-2.5 px-4 rounded-xl transition-all duration-200 {{ request()->routeIs('reports.*') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}" href="{{ route('reports.index') }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                <span class="mx-3 font-medium text-sm">Relatórios</span>
            </a>
        </div>
        @endhasrole
    </nav>
</div>
