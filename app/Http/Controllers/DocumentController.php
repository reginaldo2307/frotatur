<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Driver;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DocumentController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $soon = Carbon::today()->addDays(30);

        $expiringVehicles = Vehicle::whereBetween('insurance_expiry', [$today, $soon])
            ->orWhereBetween('doc_expiry', [$today, $soon])
            ->get();

        $expiringDrivers = Driver::whereBetween('license_expiry', [$today, $soon])
            ->get();

        return view('documents.index', compact('expiringVehicles', 'expiringDrivers'));
    }
}
