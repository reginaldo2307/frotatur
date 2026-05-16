<x-app-layout>
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center mb-6">
            <a href="{{ route('drivers.index') }}" class="text-gray-500 hover:text-gray-700 mr-4 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="text-2xl font-bold text-gray-800">Editar Motorista: {{ $driver->name }}</h2>
        </div>

        <div class="bg-white shadow-sm rounded-xl overflow-hidden border border-gray-100">
            <form action="{{ route('drivers.update', $driver) }}" method="POST" class="p-8">
                @csrf
                @method('PATCH')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="name" :value="__('Nome Completo')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $driver->name)" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="cpf" :value="__('CPF')" />
                        <x-text-input id="cpf" class="block mt-1 w-full" type="text" name="cpf" :value="old('cpf', $driver->cpf)" required />
                        <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="email" :value="__('E-mail')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $driver->email)" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="phone" :value="__('Telefone')" />
                        <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone', $driver->phone)" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <div class="md:col-span-2">
                        <x-input-label for="address" :value="__('Endereço')" />
                        <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address', $driver->address)" />
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="license_number" :value="__('Número da CNH')" />
                        <x-text-input id="license_number" class="block mt-1 w-full" type="text" name="license_number" :value="old('license_number', $driver->license_number)" required />
                        <x-input-error :messages="$errors->get('license_number')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="license_category" :value="__('Categoria')" />
                            <select name="license_category" id="license_category" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                                @foreach(['A', 'B', 'C', 'D', 'E', 'AD', 'AE'] as $cat)
                                    <option value="{{ $cat }}" {{ $driver->license_category == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-input-label for="license_expiry" :value="__('Validade')" />
                            <x-text-input id="license_expiry" class="block mt-1 w-full" type="date" name="license_expiry" :value="old('license_expiry', $driver->license_expiry)" required />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="active" :value="__('Status')" />
                        <select name="active" id="active" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                            <option value="1" {{ $driver->active ? 'selected' : '' }}>Ativo</option>
                            <option value="0" {{ !$driver->active ? 'selected' : '' }}>Inativo</option>
                        </select>
                        <x-input-error :messages="$errors->get('active')" class="mt-2" />
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <x-secondary-button type="button" class="mr-3" onclick="window.history.back()">
                        Cancelar
                    </x-secondary-button>
                    <x-primary-button>
                        Atualizar Motorista
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
