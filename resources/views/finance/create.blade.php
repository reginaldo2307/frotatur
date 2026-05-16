<x-app-layout>
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center mb-6">
            <a href="{{ route('finance.index') }}" class="text-gray-500 hover:text-gray-700 mr-4 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Nova Transação Financeira</h2>
        </div>

        <div class="bg-white dark:bg-slate-800 shadow-sm rounded-xl overflow-hidden border border-gray-100 dark:border-slate-700">
            <form action="{{ route('finance.store') }}" method="POST" class="p-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <x-input-label for="description" :value="__('Descrição / Histórico')" />
                        <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" required autofocus placeholder="Ex: Pagamento de Seguro, Recebimento Viagem #123" />
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="type" :value="__('Tipo')" />
                        <select id="type" name="type" class="block mt-1 w-full border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">
                            <option value="revenue">Receita (+)</option>
                            <option value="expense">Despesa (-)</option>
                        </select>
                        <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="amount" :value="__('Valor (R$)')" />
                        <x-text-input id="amount" class="block mt-1 w-full" type="number" step="0.01" name="amount" :value="old('amount')" required placeholder="0.00" />
                        <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="date" :value="__('Data de Referência')" />
                        <x-text-input id="date" class="block mt-1 w-full" type="date" name="date" :value="old('date', date('Y-m-d'))" required />
                        <x-input-error :messages="$errors->get('date')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="due_date" :value="__('Data de Vencimento')" />
                        <x-text-input id="due_date" class="block mt-1 w-full" type="date" name="due_date" :value="old('due_date')" />
                        <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="category" :value="__('Categoria')" />
                        <select id="category" name="category" class="block mt-1 w-full border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">
                            <option value="Viagem">Viagem</option>
                            <option value="Manutenção">Manutenção</option>
                            <option value="Combustível">Combustível</option>
                            <option value="Seguro">Seguro</option>
                            <option value="Salário">Salário</option>
                            <option value="Outros">Outros</option>
                        </select>
                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="status" :value="__('Status do Pagamento')" />
                        <select id="status" name="status" class="block mt-1 w-full border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">
                            <option value="paid">Pago / Recebido</option>
                            <option value="pending">Pendente</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <x-secondary-button type="button" class="mr-3" onclick="window.history.back()">
                        Cancelar
                    </x-secondary-button>
                    <x-primary-button>
                        Salvar Transação
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
