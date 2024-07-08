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

    public static function parentCategories()
    {
        return self::query()
            ->with('subCategories')
            ->where('parent_id', null)
            ->get();
    }

    public static function getParentCategoryOptions()
    {
        return self::query()
            ->where('parent_id', null)
            ->get()
            ->map(function (Category $category) {
                return [
                    'label' => $category->name,
                    'value' => $category->id,
                ];
            });
    }
}
