<?php

namespace App\Enums;

use App\Traits\EnumBehavior;

enum CouponType: string
{
    use EnumBehavior;

    case FIXED = 'fixed';
    case PERCENTAGE = 'percentage';
}
