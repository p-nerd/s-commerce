<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait EnumBehavior
{
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function options(): array
    {
        return array_map(
            fn ($value) => ['label' => Str::title(str_replace('_', ' ', $value)), 'value' => $value],
            array_column(self::cases(), 'value')
        );
    }
}
