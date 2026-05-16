<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'company_id', 'description', 'type', 'amount', 'status',
    'date', 'due_date', 'paid_at', 'category', 'trip_id', 'maintenance_id'
])]
class FinancialTransaction extends Model
{
    use SoftDeletes, BelongsToTenant;

    protected $casts = [
        'date' => 'date',
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function maintenance()
    {
        return $this->belongsTo(Maintenance::class);
    }
}
