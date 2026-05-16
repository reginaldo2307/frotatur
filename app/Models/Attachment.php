<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['company_id', 'file_path', 'file_name', 'file_type', 'attachable_id', 'attachable_type'])]
class Attachment extends Model
{
    use BelongsToTenant;

    public function attachable()
    {
        return $this->morphTo();
    }
}
