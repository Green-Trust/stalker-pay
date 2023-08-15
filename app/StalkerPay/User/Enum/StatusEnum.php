<?php

namespace App\StalkerPay\User\Enum;

enum StatusEnum: string
{
    case NotActive = 'NotActive';
    case Active    = 'Active';
    case Banned    = 'Banned';
}
