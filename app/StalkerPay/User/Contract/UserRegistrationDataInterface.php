<?php

namespace App\StalkerPay\User\Contract;

interface UserRegistrationDataInterface
{
    public function getName(): string;
    public function getEmail(): string;
    public function getPassword(): string;
}
