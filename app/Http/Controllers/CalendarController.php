<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        $events = Trip::with(['vehicle', 'driver'])
            ->where('status', '!=', 'cancelled')
            ->get()
            ->map(function($trip) {
                return [
                    'id' => $trip->id,
                    'title' => $trip->vehicle->plate . ' - ' . $trip->driver->name,
                    'start' => $trip->departure_time->toIso8601String(),
                    'end' => $trip->return_time ? $trip->return_time->toIso8601String() : $trip->departure_time->addHours(4)->toIso8601String(),
                    'url' => route('trips.edit', $trip),
                    'backgroundColor' => $this->getStatusColor($trip->status),
                ];
            });

        return view('calendar.index', compact('events'));
    }

    private function getStatusColor($status)
    {
        return [
            'scheduled' => '#3b82f6', // blue
            'confirmed' => '#8b5cf6', // purple
            'in_progress' => '#f59e0b', // amber
            'completed' => '#10b981', // emerald
        ][$status] ?? '#6b7280';
    }
}
