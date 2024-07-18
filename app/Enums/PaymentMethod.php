<?php

namespace App\Enums;

use App\Traits\EnumBehavior;

enum PaymentMethod: string
{
    use EnumBehavior;

    case ONLINE_GETWAY = 'online-getway';
    case CASH_ON_DELIVERY = 'cash-on-delivery';
}
