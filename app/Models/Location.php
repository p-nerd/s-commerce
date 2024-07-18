<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'value',
        'label',
        'price',
        'division_id',
    ];

    public function division()
    {
        return $this->belongsTo(Location::class, 'division_id');
    }

    public function districts(): HasMany
    {
        return $this->hasMany(Location::class, 'division_id');
    }
}
