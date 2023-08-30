<?php

namespace App\StalkerPay\User\Contract;

interface UserChangeStatusDataInterface extends UserIdentificationInterface
{
    public function getStatus(): string;
}
