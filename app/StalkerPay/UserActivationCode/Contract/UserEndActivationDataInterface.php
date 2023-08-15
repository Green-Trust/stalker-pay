<?php

namespace App\StalkerPay\UserActivationCode\Contract;

interface UserEndActivationDataInterface
{
    public function getUserId(): int;
    public function getCheckableCode(): string;
}
