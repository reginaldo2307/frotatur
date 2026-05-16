<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MercadoPagoService
{
    protected $token;

    public function __construct()
    {
        $this->token = config('services.mercadopago.token');
    }

    public function createPayment($data)
    {
        try {
            $response = Http::withToken($this->token)
                ->post('https://api.mercadopago.com/v1/payments', [
                    'transaction_amount' => $data['amount'],
                    'description' => $data['description'],
                    'payment_method_id' => $data['method'],
                    'payer' => [
                        'email' => $data['email']
                    ],
                    'notification_url' => route('webhooks.mercadopago')
                ]);

            return $response->json();
        } catch (\Exception $e) {
            Log::error("Erro Mercado Pago: " . $e->getMessage());
            return null;
        }
    }

    public function handleWebhook($data)
    {
        // Lógica para processar PIX ou Cartão via Webhook
        Log::info("Webhook Mercado Pago recebido", $data);
    }
}
