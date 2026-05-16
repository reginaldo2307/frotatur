<x-app-layout>
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center mb-6">
            <a href="{{ route('customers.index') }}" class="text-gray-500 hover:text-gray-700 mr-4 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="text-2xl font-bold text-gray-800">Editar Cliente: {{ $customer->name }}</h2>
        </div>

        <div class="bg-white shadow-sm rounded-xl overflow-hidden border border-gray-100">
            <form action="{{ route('customers.update', $customer) }}" method="POST" class="p-8">
                @csrf
                @method('PATCH')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <x-input-label for="name" :value="__('Nome Completo / Razão Social')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $customer->name)" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="document" :value="__('CPF / CNPJ')" />
                        <x-text-input id="document" class="block mt-1 w-full" type="text" name="document" :value="old('document', $customer->document)" required />
                        <x-input-error :messages="$errors->get('document')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="phone" :value="__('Telefone')" />
                        <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone', $customer->phone)" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="email" :value="__('E-mail')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $customer->email)" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="md:col-span-2">
                        <x-input-label for="address" :value="__('Endereço')" />
                        <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address', $customer->address)" />
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>

                    <div class="md:col-span-2">
                        <x-input-label for="notes" :value="__('Observações')" />
                        <textarea id="notes" name="notes" rows="4" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">{{ old('notes', $customer->notes) }}</textarea>
                        <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <x-secondary-button type="button" class="mr-3" onclick="window.history.back()">
                        Cancelar
                    </x-secondary-button>
                    <x-primary-button>
                        Atualizar Cliente
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
