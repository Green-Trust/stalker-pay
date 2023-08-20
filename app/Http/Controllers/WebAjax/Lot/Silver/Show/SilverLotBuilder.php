<?php

namespace App\Http\Controllers\WebAjax\Lot\Silver\Show;

use App\Models\SilverLot;
use App\StalkerPay\Location\Repository\LocationRepositoryInterface;
use App\StalkerPay\User\Repository\UserRepositoryInterface;
use App\UI\Lot\Silver\SilverService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SilverLotBuilder
{
    public function __construct(
        private readonly UserRepositoryInterface     $userRepository,
        private readonly LocationRepositoryInterface $locationRepository,
        private readonly SilverService               $silverService
    ) {}

    public function build(LengthAwarePaginator $silverLots): array
    {
        $nextPage = $silverLots->getUrlRange($silverLots->currentPage() + 1, $silverLots->currentPage() + 1);

        $dtoList = [
            'page' => $silverLots->currentPage(),
            'next' => array_shift($nextPage),
            'data' => [],
        ];

        /** @var SilverLot $silverLot */
        foreach ($silverLots as $silverLot) {
            $location = $this->locationRepository->getById($silverLot->location_id);
            $user     = $this->userRepository->getById($silverLot->creator_id);

            $dtoList['data'][] = [
                'id'       => $silverLot->id,
                'amount'   => $silverLot->amount . 'кк',
                'minimum'  => $silverLot->minimum . 'кк',
                'location' => $location->name,
                'type'     => $this->silverService->getType($silverLot->type),
                'creator'  => $user->name,
            ];
        }

        return $dtoList;
    }
}
