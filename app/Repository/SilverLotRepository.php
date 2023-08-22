<?php

namespace App\Repository;

use App\Models\SilverLot;
use App\StalkerPay\Lot\Silver\Repository\SilverLotRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SilverLotRepository implements SilverLotRepositoryInterface
{
    /**
     * @param int $id
     * @return SilverLot|null
     */
    public function getById(int $id): ?object
    {
        return SilverLot::query()->find($id);
    }

    public function get(int $limit = 8): LengthAwarePaginator
    {
        return SilverLot::query()
            ->paginate($limit);
    }
}
