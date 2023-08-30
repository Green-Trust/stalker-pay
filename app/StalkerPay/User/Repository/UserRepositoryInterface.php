<?php

namespace App\StalkerPay\User\Repository;

use App\Models\User;
use App\StalkerPay\User\Dto\SearchParam;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    /**
     * @return User|null
     */
    public function getById(int $id): ?object;

    public function getAll(SearchParam $searchParam): LengthAwarePaginator;

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
