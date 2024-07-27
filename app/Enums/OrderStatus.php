<?php

namespace App\Enums;

use App\Traits\EnumBehavior;

enum OrderStatus: string
{
    use EnumBehavior;

    case PENDING = 'pending';
    case PROCESSING = 'processing';
    case CONFIRM = 'confirm';
    case SHIPPED = 'shipped';
    case DELIVERD = 'DELIVERD';
    case CANCELLED = 'cancelled';
}
