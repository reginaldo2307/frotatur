<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'company_id', 'vehicle_id', 'driver_id', 'customer_id', 'passenger_count',
    'origin', 'destination', 'departure_time', 'return_time', 
    'start_km', 'end_km', 'price', 'total_expenses', 'status', 'notes'
])]
class Trip extends Model
{
    use SoftDeletes, BelongsToTenant;

    protected $casts = [
        'departure_time' => 'datetime',
        'return_time' => 'datetime',
    ];

    public function checklists()
    {
        return $this->hasMany(TripChecklist::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function transactions()
    {
        return $this->hasMany(FinancialTransaction::class);
    }
}
