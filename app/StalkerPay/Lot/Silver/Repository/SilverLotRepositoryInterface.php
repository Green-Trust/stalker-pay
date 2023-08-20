<?php

namespace App\StalkerPay\Lot\Silver\Repository;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface SilverLotRepositoryInterface
{
    public function get(int $limit = 8): LengthAwarePaginator;
}
