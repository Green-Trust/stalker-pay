<?php

namespace App\StalkerPay\Lot\Enum;

enum StatusEnum: string
{
    case NotActive = 'NotActive';
    case Active    = 'Active';
    case Sold      = 'Sold';
}
