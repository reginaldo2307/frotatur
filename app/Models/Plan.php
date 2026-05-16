<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['name', 'slug', 'price', 'max_vehicles', 'max_users', 'max_trips_monthly'])]
class Plan extends Model
{
    public function companies()
    {
        return $this->hasMany(Company::class);
    }
}
