<?php

namespace App\StalkerPay\UserActivationCode\Repository;

use App\Models\User;
use App\Models\UserActivationCode;

interface UserActivationCodeRepositoryInterface
{
    /**
     * @return UserActivationCode|null
     */
    public function getByCode(string $code): ?object;

    /**
     * @return UserActivationCode|null
     */
    public function getByUser(User $user): ?object;
}
