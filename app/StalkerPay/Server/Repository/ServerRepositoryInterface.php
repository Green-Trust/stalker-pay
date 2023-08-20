<?php

namespace App\StalkerPay\Server\Repository;

use App\Models\Server;
use Illuminate\Database\Eloquent\Collection;

interface ServerRepositoryInterface
{
    /**
     * @return Server|null
     */
    public function getById(int $id): ?object;
    public function getAll(): Collection;
}
