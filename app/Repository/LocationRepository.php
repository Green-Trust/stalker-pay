<?php

namespace App\Repository;

use App\Models\Location;
use App\StalkerPay\Location\Repository\LocationRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class LocationRepository implements LocationRepositoryInterface
{
    /**
     * @return Location|null
     */
    public function getById(int $id): ?object
    {
        return Location::query()->find($id);
    }

    public function getAll(): Collection
    {
        return Location::query()->get();
    }
}
