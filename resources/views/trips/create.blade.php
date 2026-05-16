<x-app-layout>
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center mb-6">
            <a href="{{ route('trips.index') }}" class="text-gray-500 hover:text-gray-700 mr-4 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="text-2xl font-bold text-gray-800">Agendar Nova Viagem</h2>
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
            <form action="{{ route('trips.store') }}" method="POST" class="p-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="vehicle_id" :value="__('Veículo Disponível')" />
                        <select name="vehicle_id" id="vehicle_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
                            <option value="">Selecione um veículo</option>
                            @foreach($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}">{{ $vehicle->brand }} {{ $vehicle->model }} ({{ $vehicle->plate }})</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('vehicle_id')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="driver_id" :value="__('Motorista')" />
                        <select name="driver_id" id="driver_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
                            <option value="">Selecione um motorista</option>
                            @foreach($drivers as $driver)
                                <option value="{{ $driver->id }}">{{ $driver->name }} ({{ $driver->license_category }})</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('driver_id')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="customer_id" :value="__('Cliente')" />
                        <select name="customer_id" id="customer_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                            <option value="">Particular / Outro</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('customer_id')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="passenger_count" :value="__('Quantidade de Passageiros')" />
                        <x-text-input id="passenger_count" class="block mt-1 w-full" type="number" name="passenger_count" :value="old('passenger_count')" required placeholder="Ex: 15" />
                        <x-input-error :messages="$errors->get('passenger_count')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="price" :value="__('Valor da Viagem (R$)')" />
                        <x-text-input id="price" class="block mt-1 w-full" type="number" step="0.01" name="price" :value="old('price')" placeholder="0.00" />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="start_km" :value="__('KM Inicial')" />
                        <x-text-input id="start_km" class="block mt-1 w-full" type="number" name="start_km" :value="old('start_km')" placeholder="KM do veículo na saída" />
                        <x-input-error :messages="$errors->get('start_km')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="departure_time" :value="__('Data/Hora de Partida')" />
                        <x-text-input id="departure_time" class="block mt-1 w-full" type="datetime-local" name="departure_time" :value="old('departure_time')" required />
                        <x-input-error :messages="$errors->get('departure_time')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="return_time" :value="__('Data/Hora de Retorno (Previsão)')" />
                        <x-text-input id="return_time" class="block mt-1 w-full" type="datetime-local" name="return_time" :value="old('return_time')" />
                        <x-input-error :messages="$errors->get('return_time')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="origin" :value="__('Origem')" />
                        <x-text-input id="origin" class="block mt-1 w-full" type="text" name="origin" :value="old('origin')" required placeholder="Local de saída" />
                        <x-input-error :messages="$errors->get('origin')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="destination" :value="__('Destino')" />
                        <x-text-input id="destination" class="block mt-1 w-full" type="text" name="destination" :value="old('destination')" required placeholder="Local de chegada" />
                        <x-input-error :messages="$errors->get('destination')" class="mt-2" />
                    </div>

                    <div class="md:col-span-2">
                        <x-input-label for="notes" :value="__('Observações / Roteiro')" />
                        <textarea id="notes" name="notes" rows="3" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" placeholder="Detalhes adicionais da viagem...">{{ old('notes') }}</textarea>
                        <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <x-secondary-button type="button" class="mr-3" onclick="window.history.back()">
                        Cancelar
                    </x-secondary-button>
                    <x-primary-button>
                        Confirmar Agendamento
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
