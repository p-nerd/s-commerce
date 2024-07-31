<?php

namespace App\Enums;

use App\Traits\EnumBehavior;

enum UserStatus: string
{
    use EnumBehavior;

    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case BANNED = 'banned';
}
