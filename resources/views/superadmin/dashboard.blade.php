<x-app-layout>
<div class="space-y-8">
    <!-- Header Section -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Dashboard Global</h1>
            <p class="text-slate-500 dark:text-slate-400">Visão geral da plataforma SaaS FrotaTur.</p>
        </div>
        <div class="flex gap-3">
            <button class="flex items-center gap-2 px-4 py-2 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-50 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                Exportar Dados
            </button>
            <a href="{{ route('admin.plans.create') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-medium transition-colors shadow-sm shadow-indigo-200">
                Novo Plano
            </a>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Empresas -->
        <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-50 dark:bg-blue-900/20 rounded-xl flex items-center justify-center text-blue-600 dark:text-blue-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <span class="text-xs font-medium text-emerald-600 bg-emerald-50 px-2 py-1 rounded-lg">+12%</span>
            </div>
            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Empresas Totais</p>
            <h3 class="text-2xl font-bold text-slate-800 dark:text-white mt-1">{{ $stats['total_companies'] }}</h3>
        </div>

        <!-- MRR -->
        <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-emerald-50 dark:bg-emerald-900/20 rounded-xl flex items-center justify-center text-emerald-600 dark:text-emerald-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M12 13V12"/></svg>
                </div>
                <span class="text-xs font-medium text-emerald-600 bg-emerald-50 px-2 py-1 rounded-lg">+8.5%</span>
            </div>
            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Receita Mensal (MRR)</p>
            <h3 class="text-2xl font-bold text-slate-800 dark:text-white mt-1">R$ {{ number_format($stats['mrr'], 2, ',', '.') }}</h3>
        </div>

        <!-- Veículos -->
        <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-indigo-50 dark:bg-indigo-900/20 rounded-xl flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <span class="text-xs font-medium text-slate-600 bg-slate-100 px-2 py-1 rounded-lg">Estável</span>
            </div>
            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Veículos em Gestão</p>
            <h3 class="text-2xl font-bold text-slate-800 dark:text-white mt-1">{{ $stats['total_vehicles'] }}</h3>
        </div>

        <!-- Viagens -->
        <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-orange-50 dark:bg-orange-900/20 rounded-xl flex items-center justify-center text-orange-600 dark:text-orange-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <span class="text-xs font-medium text-emerald-600 bg-emerald-50 px-2 py-1 rounded-lg">+15%</span>
            </div>
            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Viagens Realizadas</p>
            <h3 class="text-2xl font-bold text-slate-800 dark:text-white mt-1">{{ $stats['total_trips'] }}</h3>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Growth Chart -->
        <div class="lg:col-span-2 bg-white dark:bg-slate-900 p-8 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-lg font-bold text-slate-800 dark:text-white">Crescimento de Assinaturas</h3>
                <select class="bg-slate-50 dark:bg-slate-800 border-none rounded-lg text-sm text-slate-600 focus:ring-2 focus:ring-indigo-500">
                    <option>Últimos 6 meses</option>
                    <option>Último ano</option>
                </select>
            </div>
            <div class="h-80">
                <canvas id="growthChart"></canvas>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white dark:bg-slate-900 p-8 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm">
            <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-6">Atividade Recente</h3>
            <div class="space-y-6">
                @forelse($recentActivities as $activity)
                <div class="flex gap-4">
                    <div class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-700 dark:text-slate-200">{{ $activity->action ?? 'Atividade' }}</p>
                        <p class="text-xs text-slate-500">{{ $activity->description ?? ($activity->changes ? 'Alteração no sistema' : 'Ação realizada') }}</p>
                        <span class="text-[10px] text-slate-400 uppercase font-medium">{{ $activity->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                @empty
                <p class="text-sm text-slate-500">Nenhuma atividade recente.</p>
                @endforelse
            </div>
            <a href="{{ route('admin.logs.index') }}" class="block text-center w-full mt-8 py-2 text-sm font-medium text-indigo-600 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 rounded-lg transition-colors">
                Ver todos os logs
            </a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('growthChart').getContext('2d');
        const data = {!! json_encode($growthData) !!};
        
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.map(item => 'Mes ' + item.month),
                datasets: [{
                    label: 'Novas Empresas',
                    data: data.map(item => item.count),
                    borderColor: '#6366f1',
                    backgroundColor: 'rgba(99, 102, 241, 0.1)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 3,
                    pointRadius: 4,
                    pointBackgroundColor: '#6366f1'
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.05)' }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
    });
</script>
</x-app-layout>
