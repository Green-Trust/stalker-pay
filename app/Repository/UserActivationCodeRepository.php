<?php

namespace App\Repository;

use App\Models\User;
use App\Models\UserActivationCode;
use App\StalkerPay\UserActivationCode\Repository\UserActivationCodeRepositoryInterface;

class UserActivationCodeRepository implements UserActivationCodeRepositoryInterface
{
    public function getByCode(string $code): ?object
    {
        return UserActivationCode::query()
            ->where('code', '=', $code)
            ->first();
    }

    public function getByUser(User $user): ?object
    {
        return UserActivationCode::query()
            ->where('user_id', '=', $user->id)
            ->first();
    }
}
