<?php

namespace App\StalkerPay\User\Service;

use App\StalkerPay\User\Repository\UserRepositoryInterface;

class UuidProvider
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {}

    public function getNearestAvailable(): int
    {
        return $this->userRepository->getLastUuid() + 1;
    }
}
