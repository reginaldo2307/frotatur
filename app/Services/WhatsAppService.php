<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    protected $apiUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->apiUrl = config('services.whatsapp.url');
        $this->apiKey = config('services.whatsapp.key');
    }

    public function sendMessage($to, $message)
    {
        try {
            // Exemplo para Evolution API ou Cloud API
            $response = Http::withHeaders([
                'apikey' => $this->apiKey
            ])->post($this->apiUrl . '/message/sendText', [
                'number' => $to,
                'text' => $message
            ]);

            return $response->successful();
        } catch (\Exception $e) {
            Log::error("Erro WhatsApp: " . $e->getMessage());
            return false;
        }
    }

    public function sendConfirmation($trip)
    {
        $message = "Olá {$trip->customer->name}! Sua viagem para {$trip->destination} está agendada para " . $trip->departure_time->format('d/m/Y H:i');
        return $this->sendMessage($trip->customer->phone, $message);
    }
}
