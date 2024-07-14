<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function featuredImage(): ?ProductImage
    {
        return $this->images()->where('featured', true)->first();
    }

    public function discountPercentage()
    {
        $discount = ($this->price - $this->discount_price) / $this->price * 100;

        return round($discount, 2); // Round to 2 decimal places
    }
}
