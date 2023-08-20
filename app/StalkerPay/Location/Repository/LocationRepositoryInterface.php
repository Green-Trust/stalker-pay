<?php

namespace App\StalkerPay\Location\Repository;

use App\Models\Location;
use Illuminate\Database\Eloquent\Collection;

interface LocationRepositoryInterface
{
    /**
     * @return Location|null
     */
    public function getById(int $id): ?object;
    public function getAll(): Collection;
}
