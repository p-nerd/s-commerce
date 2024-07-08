<?php

namespace App\Traits;

trait HasSlug
{
    public static function generateSlug(string $name): string
    {
        $slug = str()->slug($name);
        if (self::query()->where('slug', $slug)->first()) {
            $count = self::count() + 1;
            $slug .= "$count";
        }

        return $slug;
    }
}
