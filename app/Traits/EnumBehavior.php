<?php

namespace App\Traits;

trait EnumBehavior
{
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function options(): array
    {
        return collect(self::values())
            ->map(fn ($value) => [
                'label' => ucwords($value),
                'value' => $value,
            ])
            ->toArray();
    }
}
