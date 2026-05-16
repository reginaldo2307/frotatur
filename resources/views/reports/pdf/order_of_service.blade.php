<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ordem de Serviço #{{ $trip->id }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .section { margin-bottom: 20px; }
        .section-title { font-weight: bold; background: #eee; padding: 5px; margin-bottom: 10px; }
        .grid { width: 100%; border-collapse: collapse; }
        .grid td { padding: 5px; border: 1px solid #ddd; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>ORDEM DE SERVIÇO</h1>
        <p>{{ $trip->company->name }} | CNPJ: {{ $trip->company->document }}</p>
    </div>

    <div class="section">
        <div class="section-title">DADOS DA VIAGEM #{{ $trip->id }}</div>
        <table class="grid">
            <tr>
                <td width="20%"><b>Origem:</b></td>
                <td width="30%">{{ $trip->origin }}</td>
                <td width="20%"><b>Destino:</b></td>
                <td width="30%">{{ $trip->destination }}</td>
            </tr>
            <tr>
                <td><b>Saída:</b></td>
                <td>{{ $trip->departure_time->format('d/m/Y H:i') }}</td>
                <td><b>Retorno:</b></td>
                <td>{{ $trip->return_time ? $trip->return_time->format('d/m/Y H:i') : '---' }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">RECURSOS ALOCADOS</div>
        <table class="grid">
            <tr>
                <td width="20%"><b>Veículo:</b></td>
                <td width="30%">{{ $trip->vehicle->model }} ({{ $trip->vehicle->plate }})</td>
                <td width="20%"><b>Motorista:</b></td>
                <td width="30%">{{ $trip->driver->name }}</td>
            </tr>
            <tr>
                <td><b>Capacidade:</b></td>
                <td>{{ $trip->vehicle->capacity }} Lugares</td>
                <td><b>Passageiros:</b></td>
                <td>{{ $trip->passenger_count }} Pessoas</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">CLIENTE</div>
        <table class="grid">
            <tr>
                <td width="20%"><b>Nome:</b></td>
                <td>{{ $trip->customer->name ?? 'Particular' }}</td>
            </tr>
            <tr>
                <td><b>Documento:</b></td>
                <td>{{ $trip->customer->document ?? '---' }}</td>
            </tr>
        </table>
    </div>

    <div class="section" style="margin-top: 50px;">
        <table width="100%">
            <tr>
                <td width="45%" style="border-top: 1px solid #000; text-align: center;">Assinatura do Motorista</td>
                <td width="10%"></td>
                <td width="45%" style="border-top: 1px solid #000; text-align: center;">Assinatura do Responsável</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        Gerado automaticamente por FrotaTur SaaS em {{ date('d/m/Y H:i') }}
    </div>
</body>
</html>
