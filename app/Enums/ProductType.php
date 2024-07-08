<?php

namespace App\Enums;

use App\Traits\EnumBehavior;

enum ProductType: string
{
    use EnumBehavior;

    case PHYSICAL = 'physical';
    case DIGITAL = 'digital';
}
