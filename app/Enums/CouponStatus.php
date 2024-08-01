<?php

namespace App\Enums;

use App\Traits\EnumBehavior;

enum CouponStatus: string
{
    use EnumBehavior;

    case ENABLED = 'enabled';
    case DISABLED = 'disabled';
}
