<?php

namespace App\StalkerPay\UserActivationCode\Service;

use App\Models\UserActivationCode;
use DateTime;

class UserActivationCodeTtlChecker
{
    public function __construct(
        private readonly int $userActivationCodeReplyTtlMinutes,
        private readonly int $userActivationCodeTtlMinutes
    ) {}

    public function canReply(UserActivationCode $userActivationCode): bool
    {
        $now       = new DateTime();
        $expiredAt = clone $userActivationCode->created_at;
        $expiredAt->modify("+{$this->userActivationCodeReplyTtlMinutes} minutes");

        return $now > $expiredAt;
    }

    public function canActivate(UserActivationCode $userActivationCode): bool
    {
        $now       = new DateTime();
        $expiredAt = clone $userActivationCode->created_at;
        $expiredAt->modify("+{$this->userActivationCodeTtlMinutes} minutes");

        return $now < $expiredAt;
    }
}
