<?php

namespace App\Enums;

use App\Traits\EnumBehavior;

enum UserRole: string
{
    use EnumBehavior;

    case CUSTOMER = 'customer';
    case ADMIN = 'admin';
}
