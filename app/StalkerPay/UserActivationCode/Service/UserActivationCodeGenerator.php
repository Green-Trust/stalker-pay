<?php

namespace App\StalkerPay\UserActivationCode\Service;

use App\Models\User;
use App\Models\UserActivationCode;
use App\StalkerPay\UserActivationCode\Repository\UserActivationCodeRepositoryInterface;
use Illuminate\Support\Str;

class UserActivationCodeGenerator
{
    private const CODE_LENGTH = 8;

    public function __construct(
        private readonly UserActivationCodeRepositoryInterface $userActivationCodeRepository
    ) {}

    public function generate(User $user): UserActivationCode
    {
        $code = Str::random(self::CODE_LENGTH);

        while (!is_null($this->userActivationCodeRepository->getByCode($code))) {
            $code = Str::random(self::CODE_LENGTH);
        }

        $userActivationCode          = new UserActivationCode();
        $userActivationCode->user_id = $user->id;
        $userActivationCode->code    = $code;
        $userActivationCode->save();

        return $userActivationCode;
    }
}
