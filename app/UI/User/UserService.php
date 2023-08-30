<?php

namespace App\UI\User;

use App\StalkerPay\User\Enum\StatusEnum;

class UserService
{
    public function getStatusLabel(string $status): string
    {
        return match ($status) {
            StatusEnum::Active->value    => 'Активный',
            StatusEnum::NotActive->value => 'Не активный',
            StatusEnum::Banned->value    => 'Заблокирован',
            default                      => ''
        };
    }
}
