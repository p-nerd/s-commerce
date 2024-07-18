<?php

namespace App\Enums;

use App\Traits\EnumBehavior;

enum OrderStatus: string
{
    use EnumBehavior;

    case PENDING = 'pending';
    case PROCESSING = 'processing';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';
}
