<?php

namespace App\StalkerPay\Lot\Silver\Repository;

use App\Models\SilverLot;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface SilverLotRepositoryInterface
{
    /**
     * @param int $id
     * @return SilverLot|null
     */
    public function getById(int $id): ?object;
    public function get(int $limit = 8): LengthAwarePaginator;
}
