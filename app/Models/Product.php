<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, HasSlug, SoftDeletes;

    protected $fillable = [
        'name',
        'short_description',
        'type',
        'sku',
        'price',
        'discount_price',
        'manufactured_date',
        'expired_date',
        'stock',
        'category_id',
        'long_description',
        'slug',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
