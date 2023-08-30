<?php

namespace App\Repository;

use App\Models\User;
use App\StalkerPay\User\Dto\SearchParam;
use App\StalkerPay\User\Repository\UserRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository implements UserRepositoryInterface
{

    public function getById(int $id): ?object
    {
        return User::query()->find($id);
    }

    public function getByEmail(string $email): ?object
    {
        return User::query()
            ->where('email', '=', $email)
            ->first();
    }

    public function getByName(string $name): ?object
    {
        return User::query()
            ->where('name', '=', $name)
            ->first();
    }

    public function getLastUuid(): int
    {
        /** @var User|null $user */
        $user = User::query()
            ->orderBy('uuid', 'DESC')
            ->first();

        return !is_null($user) ? $user->uuid : 0;
    }

    public function getAll(SearchParam $searchParam): LengthAwarePaginator
    {
        return User::query()
            ->paginate($searchParam->getLimit());
    }
}
