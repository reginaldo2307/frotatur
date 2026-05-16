<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'company_id', 'user_id', 'name', 'cpf', 'email', 'phone', 'address',
    'license_number', 'license_category', 'license_expiry', 'active'
])]
class Driver extends Model
{
    use SoftDeletes, BelongsToTenant;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }
}
