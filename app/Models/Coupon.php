<?php

namespace App\Models;

use App\Enums\CouponType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'discount',
        'type',
        'expires_at',
    ];

    protected function casts(): array
    {
        return [
            'type' => CouponType::class,
            'expires_at' => 'date',
        ];
    }
}
