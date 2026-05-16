<x-app-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Centro de Relatórios e Performance</h2>
        <p class="text-gray-500 text-sm">Analise a rentabilidade da sua frota e custos operacionais.</p>
    </div>

    <div class="bg-white shadow-sm rounded-xl overflow-hidden border border-gray-100">
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
            <h3 class="font-bold text-gray-700">Lucratividade por Veículo</h3>
        </div>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Veículo</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Viagens</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Receita Total</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Despesas Est.</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lucro Líquido</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($profitPerVehicle as $item)
                <tr class="hover:bg-gray-50 transition-colors duration-150">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                        {{ $item['vehicle'] }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $item['trips_count'] }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 font-bold">
                        R$ {{ number_format($item['revenue'], 2, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-red-600">
                        R$ {{ number_format($item['expenses'], 2, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <span class="font-bold {{ $item['profit'] >= 0 ? 'text-blue-600' : 'text-orange-600' }}">
                            R$ {{ number_format($item['profit'], 2, ',', '.') }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-indigo-600 p-6 rounded-xl text-white shadow-lg">
            <h4 class="font-bold text-lg mb-2">Dica de Gestão</h4>
            <p class="text-indigo-100 text-sm">Veículos com lucro líquido baixo ou negativo podem estar precisando de manutenção preventiva ou revisão na precificação das viagens.</p>
        </div>
        <div class="bg-emerald-600 p-6 rounded-xl text-white shadow-lg">
            <h4 class="font-bold text-lg mb-2">Exportação Disponível</h4>
            <p class="text-emerald-100 text-sm">Em breve: Exportação completa de relatórios em PDF e Excel para contabilidade.</p>
        </div>
    </div>
</x-app-layout>
