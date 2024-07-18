<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    public function districts(): HasMany
    {
        return $this->hasMany(Location::class, 'division_id');
    }
}
