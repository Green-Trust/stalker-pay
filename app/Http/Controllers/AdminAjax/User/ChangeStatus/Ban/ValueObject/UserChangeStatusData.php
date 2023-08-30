<?php

namespace App\Http\Controllers\AdminAjax\User\ChangeStatus\Ban\ValueObject;

use App\StalkerPay\User\Contract\UserChangeStatusDataInterface;
use App\StalkerPay\User\Enum\StatusEnum;

class UserChangeStatusData implements UserChangeStatusDataInterface
{
    public function __construct(
        private readonly int $userId
    ) {}

    public function getStatus(): string
    {
        return StatusEnum::Banned->value;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}
