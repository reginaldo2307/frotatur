<x-app-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Central de Documentos e Vencimentos</h2>
        <p class="text-gray-500 text-sm">Monitore seguros, licenciamentos e CNHs com vencimento próximo.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Veículos -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-700 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                    </svg>
                    Vencimentos de Veículos (30 dias)
                </h3>
            </div>
            <div class="p-6">
                @forelse($expiringVehicles as $vehicle)
                <div class="flex justify-between items-center p-3 mb-3 bg-orange-50 rounded-lg border border-orange-100">
                    <div>
                        <p class="text-sm font-bold text-gray-900">{{ $vehicle->plate }} - {{ $vehicle->model }}</p>
                        <p class="text-xs text-orange-700">
                            Seguro: {{ $vehicle->insurance_expiry->format('d/m/Y') }}
                        </p>
                    </div>
                    <a href="{{ route('vehicles.edit', $vehicle) }}" class="text-xs font-bold text-blue-600 hover:underline">Ver detalhes</a>
                </div>
                @empty
                <p class="text-center text-gray-500 py-4">Nenhum veículo com vencimento próximo.</p>
                @endforelse
            </div>
        </div>

        <!-- Motoristas -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-700 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Vencimentos de CNH (30 dias)
                </h3>
            </div>
            <div class="p-6">
                @forelse($expiringDrivers as $driver)
                <div class="flex justify-between items-center p-3 mb-3 bg-red-50 rounded-lg border border-red-100">
                    <div>
                        <p class="text-sm font-bold text-gray-900">{{ $driver->name }}</p>
                        <p class="text-xs text-red-700">CNH: {{ $driver->license_expiry->format('d/m/Y') }}</p>
                    </div>
                    <a href="{{ route('drivers.edit', $driver) }}" class="text-xs font-bold text-blue-600 hover:underline">Ver detalhes</a>
                </div>
                @empty
                <p class="text-center text-gray-500 py-4">Nenhum motorista com CNH vencendo.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
