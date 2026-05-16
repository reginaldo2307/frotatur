<x-app-layout>
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center mb-6">
            <a href="{{ route('maintenances.index') }}" class="text-gray-500 hover:text-gray-700 mr-4 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="text-2xl font-bold text-gray-800">Registrar Manutenção</h2>
        </div>

        @if($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm" role="alert">
            <p class="font-bold">Ops! Ocorreram alguns erros:</p>
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="bg-white shadow-sm rounded-xl overflow-hidden border border-gray-100">
            <form action="{{ route('maintenances.store') }}" method="POST" class="p-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="vehicle_id" :value="__('Veículo')" />
                        <select name="vehicle_id" id="vehicle_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
                            <option value="">Selecione um veículo</option>
                            @foreach($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}">{{ $vehicle->plate }} - {{ $vehicle->model }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('vehicle_id')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="type" :value="__('Tipo de Manutenção')" />
                        <select name="type" id="type" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
                            <option value="preventive">Preventiva</option>
                            <option value="corrective">Corretiva</option>
                        </select>
                        <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="date" :value="__('Data da Manutenção')" />
                        <x-text-input id="date" class="block mt-1 w-full" type="date" name="date" :value="old('date', date('Y-m-d'))" required />
                        <x-input-error :messages="$errors->get('date')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="cost" :value="__('Custo Total (R$)')" />
                        <x-text-input id="cost" class="block mt-1 w-full" type="number" step="0.01" name="cost" :value="old('cost')" required placeholder="0.00" />
                        <x-input-error :messages="$errors->get('cost')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="km_at_maintenance" :value="__('Quilometragem Atual')" />
                        <x-text-input id="km_at_maintenance" class="block mt-1 w-full" type="number" name="km_at_maintenance" :value="old('km_at_maintenance')" placeholder="Opcional" />
                        <x-input-error :messages="$errors->get('km_at_maintenance')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="provider" :value="__('Oficina / Fornecedor')" />
                        <x-text-input id="provider" class="block mt-1 w-full" type="text" name="provider" :value="old('provider')" placeholder="Nome da oficina" />
                        <x-input-error :messages="$errors->get('provider')" class="mt-2" />
                    </div>

                    <div class="md:col-span-2">
                        <x-input-label for="description" :value="__('Descrição dos Serviços')" />
                        <textarea id="description" name="description" rows="3" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" placeholder="Ex: Troca de óleo, filtros e pastilhas de freio..." required>{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <x-secondary-button type="button" class="mr-3" onclick="window.history.back()">
                        Cancelar
                    </x-secondary-button>
                    <x-primary-button>
                        Salvar Manutenção
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
