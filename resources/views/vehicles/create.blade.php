<x-app-layout>
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center mb-6">
            <a href="{{ route('vehicles.index') }}" class="text-gray-500 hover:text-gray-700 mr-4 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="text-2xl font-bold text-gray-800">Novo Veículo</h2>
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
            <form action="{{ route('vehicles.store') }}" method="POST" class="p-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="brand" :value="__('Marca')" />
                        <x-text-input id="brand" class="block mt-1 w-full" type="text" name="brand" :value="old('brand')" required autofocus placeholder="Ex: Mercedes-Benz" />
                        <x-input-error :messages="$errors->get('brand')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="model" :value="__('Modelo')" />
                        <x-text-input id="model" class="block mt-1 w-full" type="text" name="model" :value="old('model')" required placeholder="Ex: Sprinter 515" />
                        <x-input-error :messages="$errors->get('model')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="plate" :value="__('Placa')" />
                        <x-text-input id="plate" class="block mt-1 w-full" type="text" name="plate" :value="old('plate')" required placeholder="Ex: ABC-1234" />
                        <x-input-error :messages="$errors->get('plate')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="year" :value="__('Ano')" />
                        <x-text-input id="year" class="block mt-1 w-full" type="number" name="year" :value="old('year')" required placeholder="Ex: 2022" />
                        <x-input-error :messages="$errors->get('year')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="current_km" :value="__('KM Inicial')" />
                        <x-text-input id="current_km" class="block mt-1 w-full" type="number" name="current_km" :value="old('current_km')" required placeholder="Ex: 0" />
                        <x-input-error :messages="$errors->get('current_km')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="capacity" :value="__('Capacidade (Passageiros)')" />
                        <x-text-input id="capacity" class="block mt-1 w-full" type="number" name="capacity" :value="old('capacity')" required placeholder="Ex: 15" />
                        <x-input-error :messages="$errors->get('capacity')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="fuel_type" :value="__('Tipo de Combustível')" />
                        <select id="fuel_type" name="fuel_type" class="block mt-1 w-full border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">
                            <option value="Diesel">Diesel</option>
                            <option value="Gasolina">Gasolina</option>
                            <option value="Flex">Flex</option>
                            <option value="GNV">GNV</option>
                        </select>
                        <x-input-error :messages="$errors->get('fuel_type')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="color" :value="__('Cor')" />
                        <x-text-input id="color" class="block mt-1 w-full" type="text" name="color" :value="old('color')" placeholder="Ex: Branco" />
                        <x-input-error :messages="$errors->get('color')" class="mt-2" />
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <x-secondary-button type="button" class="mr-3" onclick="window.history.back()">
                        Cancelar
                    </x-secondary-button>
                    <x-primary-button>
                        Salvar Veículo
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
