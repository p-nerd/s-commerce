<?php

namespace App\Enums;

use App\Traits\EnumBehavior;

enum OptionType: string
{
    use EnumBehavior;

    case STRING = 'string';
    case INTEGER = 'integer';
    case BOOLEAN = 'boolean';
    case ARRAY = 'array';
}
