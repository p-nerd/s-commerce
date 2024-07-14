<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_id',
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function productCounts()
    {
        $count = $this->products()->count();

        $subCategories = $this->subCategories()->with('products')->get();

        foreach ($subCategories as $subCategory) {
            $count += count($subCategory->products);
        }

        return $count;
    }

    public static function parentCategories()
    {
        return self::query()
            ->where('parent_id', null)
            ->get();
    }

    public static function options()
    {
        return Category::select('name AS label', 'id AS value')
            ->orderBy('name')
            ->get();
    }

    public static function parentOptions()
    {
        return Category::select('name AS label', 'id AS value')
            ->where('parent_id', null)
            ->orderBy('name')
            ->get();
    }
}
