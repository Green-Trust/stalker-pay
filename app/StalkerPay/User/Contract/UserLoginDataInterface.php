<?php

namespace App\StalkerPay\User\Contract;

interface UserLoginDataInterface
{
    public function getEmail(): string;
    public function getPassword(): string;
}
