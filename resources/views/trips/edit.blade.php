<x-app-layout>
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center mb-6">
            <a href="{{ route('trips.index') }}" class="text-gray-500 hover:text-gray-700 mr-4 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="text-2xl font-bold text-gray-800">Editar Viagem #{{ $trip->id }}</h2>
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
            <form action="{{ route('trips.update', $trip) }}" method="POST" class="p-8">
                @csrf
                @method('PATCH')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="vehicle_id" :value="__('Veículo')" />
                        <select name="vehicle_id" id="vehicle_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
                            @foreach($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}" {{ $trip->vehicle_id == $vehicle->id ? 'selected' : '' }}>
                                    {{ $vehicle->brand }} {{ $vehicle->model }} ({{ $vehicle->plate }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <x-input-label for="driver_id" :value="__('Motorista')" />
                        <select name="driver_id" id="driver_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
                            @foreach($drivers as $driver)
                                <option value="{{ $driver->id }}" {{ $trip->driver_id == $driver->id ? 'selected' : '' }}>
                                    {{ $driver->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <x-input-label for="customer_id" :value="__('Cliente')" />
                        <select name="customer_id" id="customer_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                            <option value="">Particular / Outro</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" {{ $trip->customer_id == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <x-input-label for="status" :value="__('Status da Viagem')" />
                        <select name="status" id="status" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
                            <option value="scheduled" {{ $trip->status == 'scheduled' ? 'selected' : '' }}>Agendada</option>
                            <option value="in_progress" {{ $trip->status == 'in_progress' ? 'selected' : '' }}>Em Curso</option>
                            <option value="completed" {{ $trip->status == 'completed' ? 'selected' : '' }}>Concluída</option>
                            <option value="cancelled" {{ $trip->status == 'cancelled' ? 'selected' : '' }}>Cancelada</option>
                        </select>
                    </div>

                    <div>
                        <x-input-label for="departure_time" :value="__('Data/Hora de Partida')" />
                        <x-text-input id="departure_time" class="block mt-1 w-full" type="datetime-local" name="departure_time" :value="old('departure_time', $trip->departure_time->format('Y-m-d\TH:i'))" required />
                    </div>

                    <div>
                        <x-input-label for="return_time" :value="__('Data/Hora de Retorno')" />
                        <x-text-input id="return_time" class="block mt-1 w-full" type="datetime-local" name="return_time" :value="old('return_time', $trip->return_time ? $trip->return_time->format('Y-m-d\TH:i') : '')" />
                    </div>

                    <div>
                        <x-input-label for="passenger_count" :value="__('Passageiros')" />
                        <x-text-input id="passenger_count" class="block mt-1 w-full" type="number" name="passenger_count" :value="old('passenger_count', $trip->passenger_count)" required />
                    </div>

                    <div>
                        <x-input-label for="price" :value="__('Valor (R$)')" />
                        <x-text-input id="price" class="block mt-1 w-full" type="number" step="0.01" name="price" :value="old('price', $trip->price)" />
                    </div>

                    <div>
                        <x-input-label for="start_km" :value="__('KM Inicial')" />
                        <x-text-input id="start_km" class="block mt-1 w-full" type="number" name="start_km" :value="old('start_km', $trip->start_km)" />
                    </div>

                    <div>
                        <x-input-label for="end_km" :value="__('KM Final')" />
                        <x-text-input id="end_km" class="block mt-1 w-full" type="number" name="end_km" :value="old('end_km', $trip->end_km)" />
                    </div>

                    <div>
                        <x-input-label for="origin" :value="__('Origem')" />
                        <x-text-input id="origin" class="block mt-1 w-full" type="text" name="origin" :value="old('origin', $trip->origin)" required />
                    </div>

                    <div>
                        <x-input-label for="destination" :value="__('Destino')" />
                        <x-text-input id="destination" class="block mt-1 w-full" type="text" name="destination" :value="old('destination', $trip->destination)" required />
                    </div>

                    <div class="md:col-span-2">
                        <x-input-label for="notes" :value="__('Observações')" />
                        <textarea id="notes" name="notes" rows="3" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">{{ old('notes', $trip->notes) }}</textarea>
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <x-secondary-button type="button" class="mr-3" onclick="window.history.back()">
                        Cancelar
                    </x-secondary-button>
                    <x-primary-button>
                        Atualizar Viagem
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
