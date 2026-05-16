<x-app-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Visão Geral</h1>
        <p class="text-gray-500 dark:text-slate-400">Bem-vindo de volta! Aqui está o que está acontecendo com sua frota hoje.</p>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700">
            <div class="flex items-center justify-between mb-4">
                <div class="p-2 bg-blue-50 dark:bg-blue-900/30 rounded-lg text-blue-600 dark:text-blue-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" /></svg>
                </div>
                <span class="text-xs font-bold text-emerald-500 bg-emerald-50 dark:bg-emerald-900/30 px-2 py-1 rounded-full">+12%</span>
            </div>
            <p class="text-sm text-gray-500 dark:text-slate-400 font-medium">Veículos Ativos</p>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalVehicles }}</p>
        </div>

        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700">
            <div class="flex items-center justify-between mb-4">
                <div class="p-2 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg text-indigo-600 dark:text-indigo-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>
                </div>
                <span class="text-xs font-bold text-blue-500 bg-blue-50 dark:bg-blue-900/30 px-2 py-1 rounded-full">Hoje</span>
            </div>
            <p class="text-sm text-gray-500 dark:text-slate-400 font-medium">Viagens do Dia</p>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $tripsToday }}</p>
        </div>

        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700">
            <div class="flex items-center justify-between mb-4">
                <div class="p-2 bg-emerald-50 dark:bg-emerald-900/30 rounded-lg text-emerald-600 dark:text-emerald-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <span class="text-xs font-bold text-emerald-500 bg-emerald-50 dark:bg-emerald-900/30 px-2 py-1 rounded-full">Mensal</span>
            </div>
            <p class="text-sm text-gray-500 dark:text-slate-400 font-medium">Receita Estimada</p>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">R$ {{ number_format($monthlyRevenue, 2, ',', '.') }}</p>
        </div>

        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700">
            <div class="flex items-center justify-between mb-4">
                <div class="p-2 bg-rose-50 dark:bg-rose-900/30 rounded-lg text-rose-600 dark:text-rose-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                </div>
                <span class="text-xs font-bold text-rose-500 bg-rose-50 dark:bg-rose-900/30 px-2 py-1 rounded-full">Atenção</span>
            </div>
            <p class="text-sm text-gray-500 dark:text-slate-400 font-medium">Alertas Ativos</p>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $alertsCount }}</p>
        </div>
    </div>

    <!-- Charts and Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 bg-white dark:bg-slate-800 p-8 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Fluxo Financeiro</h3>
                <select class="bg-gray-50 dark:bg-slate-700 border-none rounded-lg text-xs font-bold focus:ring-0">
                    <option>Últimos 7 dias</option>
                    <option>Últimos 30 dias</option>
                </select>
            </div>
            <canvas id="revenueChart" height="120"></canvas>
        </div>

        <div class="bg-white dark:bg-slate-800 p-8 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6">Próximas Viagens</h3>
            <div class="space-y-6">
                @forelse($upcomingTrips as $trip)
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-blue-50 dark:bg-blue-900/30 rounded-xl flex items-center justify-center text-blue-600 dark:text-blue-400 font-bold mr-4">
                        {{ $trip->departure_time->format('d') }}
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-bold text-gray-900 dark:text-white">{{ $trip->destination }}</p>
                        <p class="text-xs text-gray-500 dark:text-slate-400">{{ $trip->driver?->name ?? 'Sem Motorista' }} • {{ $trip->departure_time->format('H:i') }}</p>
                    </div>
                    <div class="text-right">
                        <span class="text-xs font-bold text-blue-600 dark:text-blue-400">R$ {{ number_format($trip->price, 0) }}</span>
                    </div>
                </div>
                @empty
                <p class="text-center text-gray-500 py-4">Nenhuma viagem agendada.</p>
                @endforelse
            </div>
            <a href="{{ route('trips.index') }}" class="block text-center mt-8 text-sm font-bold text-blue-600 dark:text-blue-400 hover:underline">Ver todas as viagens</a>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('revenueChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($financialChartLabels ?? []) !!},
                datasets: [{
                    label: 'Faturamento',
                    data: {!! json_encode($financialChartData ?? []) !!},
                    borderColor: '#2563eb',
                    backgroundColor: 'rgba(37, 99, 235, 0.1)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 3,
                    pointRadius: 4,
                    pointBackgroundColor: '#2563eb'
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { display: false }, ticks: { color: '#94a3b8' } },
                    x: { grid: { display: false }, ticks: { color: '#94a3b8' } }
                }
            }
        });
    </script>
    @endpush
</x-app-layout>
