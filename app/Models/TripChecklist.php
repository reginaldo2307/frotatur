<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['trip_id', 'type', 'items', 'observations'])]
class TripChecklist extends Model
{
    protected $casts = [
        'items' => 'json'
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}
