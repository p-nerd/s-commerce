<?php

namespace App\Models;

use App\Enums\CouponStatus;
use App\Enums\CouponType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'type',
        'discount',
        'expires_at',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'type' => CouponType::class,
            'status' => CouponStatus::class,
            'expires_at' => 'date',
        ];
    }

    public function valid(): bool
    {
        return $this->status === CouponStatus::ENABLED && ($this->expires_at === null || $this->expires_at->isFuture());
    }

    public function amount($total)
    {
        return $this->type === CouponType::PERCENTAGE ? $total * ($this->discount / 100) : $this->discount;
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
