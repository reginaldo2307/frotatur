<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['company_id', 'name', 'document', 'email', 'phone', 'address', 'notes'])]
class Customer extends Model
{
    use SoftDeletes, BelongsToTenant;

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }
}
