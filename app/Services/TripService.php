<?php

namespace App\Services;

use App\Models\Trip;
use App\Models\Vehicle;
use App\Services\WhatsAppService;
use Illuminate\Support\Facades\DB;

class TripService
{
    public function __construct(
        protected WhatsAppService $whatsapp
    ) {}

    public function scheduleTrip(array $data)
    {
        return DB::transaction(function () use ($data) {
            $trip = Trip::create($data);
            
            // Notificar via WhatsApp se houver telefone
            if ($trip->customer && $trip->customer->phone) {
                $this->whatsapp->sendConfirmation($trip);
            }

            return $trip;
        });
    }

    public function updateStatus(Trip $trip, $status)
    {
        $trip->update(['status' => $status]);
        
        // Regras de negócio ao mudar status
        if ($status == 'finalizada') {
            $trip->vehicle->update(['status' => 'available']);
        }

        return $trip;
    }
}
