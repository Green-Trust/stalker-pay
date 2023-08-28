<?php

namespace App\Http\Controllers\Web\Lot\Silver\View;

use App\Http\Controllers\Web\Lot\Silver\View\Dto\SilverLotViewDto;
use App\Models\SilverLot;
use App\StalkerPay\Location\Repository\LocationRepositoryInterface;
use App\StalkerPay\Server\Repository\ServerRepositoryInterface;
use App\StalkerPay\User\Repository\UserRepositoryInterface;
use App\UI\Lot\Silver\SilverService;

class SilverLotViewDtoBuilder
{
    public function __construct(
        private readonly UserRepositoryInterface     $userRepository,
        private readonly LocationRepositoryInterface $locationRepository,
        private readonly ServerRepositoryInterface   $serverRepository,
        private readonly UserViewDtoBuilder          $userViewDtoBuilder,
        private readonly SilverService               $silverService
    ) {}

    public function build(SilverLot $silverLot): SilverLotViewDto
    {
        $user     = $this->userRepository->getById($silverLot->creator_id);
        $location = $this->locationRepository->getById($silverLot->location_id);
        $server   = $this->serverRepository->getById($silverLot->server_id);

        return (new SilverLotViewDto())
            ->setId($silverLot->id)
            ->setAmount($silverLot->amount)
            ->setMinimum($silverLot->minimum)
            ->setPrice($silverLot->price)
            ->setDescription($silverLot->description)
            ->setType($this->silverService->getType($silverLot->type))
            ->setCreator(
                $this->userViewDtoBuilder->build($user)
            )
            ->setLocation($location->name)
            ->setServer($server->name);
    }
}
