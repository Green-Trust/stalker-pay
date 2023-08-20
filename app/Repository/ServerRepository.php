<?php

namespace App\Repository;

use App\Models\Server;
use App\StalkerPay\Server\Repository\ServerRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ServerRepository implements ServerRepositoryInterface
{
    /**
     * @return Server|null
     */
    public function getById(int $id): ?object
    {
        return Server::query()->find($id);
    }

    public function getAll(): Collection
    {
        return Server::query()->get();
    }
}
