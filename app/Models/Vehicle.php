<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'company_id', 'plate', 'model', 'brand', 'year', 'capacity', 'fuel_type',
    'color', 'renavam', 'chassis', 'current_km', 'status', 
    'insurance_expiry', 'doc_expiry'
])]
class Vehicle extends Model
{
    use SoftDeletes, BelongsToTenant;

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }
}
