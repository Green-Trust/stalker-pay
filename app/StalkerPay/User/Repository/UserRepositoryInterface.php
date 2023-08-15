<?php

namespace App\StalkerPay\User\Repository;

use App\Models\User;

interface UserRepositoryInterface
{
    /**
     * @return User|null
     */
    public function getById(int $id): ?object;

    /**
     * @return User|null
     */
    public function getByEmail(string $email): ?object;

    /**
     * @return User|null
     */
    public function getByName(string $name): ?object;

    public function getLastUuid(): int;
}
