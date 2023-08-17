<?php

namespace App\Http\Controllers\WebAjax\Login\ValueObject;

class UserLoginData implements \App\StalkerPay\User\Contract\UserLoginDataInterface
{
    public function __construct(
        private readonly string $email,
        private readonly string $password
    ) {}

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
