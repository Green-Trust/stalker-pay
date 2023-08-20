<?php

namespace App\Http\Controllers\WebAjax\Lot\FormInfo;

use App\Models\Location;
use App\Models\Server;
use App\StalkerPay\Location\Repository\LocationRepositoryInterface;
use App\StalkerPay\Server\Repository\ServerRepositoryInterface;
use App\UI\Lot\Silver\SilverService;

class FormInfoBuilder
{
    public function __construct(
        private readonly LocationRepositoryInterface $locationRepository,
        private readonly ServerRepositoryInterface   $serverRepository,
        private readonly SilverService               $silverService
    ) {}

    public function build(): array
    {
        /** @var Location[] $locations */
        $locations = $this->locationRepository->getAll();
        /** @var Server[] $servers */
        $servers   = $this->serverRepository->getAll();

        $locationsDto = [];
        foreach ($locations as $location) {
            $locationsDto[$location->id] = $location->name;
        }

        $serverDto = [];
        foreach ($servers as $server) {
            $serverDto[$server->id] = $server->name;
        }

        return [
            'silver' => [
                'type' => $this->silverService->getAllTypes(),
            ],
            'common' => [
                'locations' => $locationsDto,
                'servers'   => $serverDto,
            ]
        ];
    }
}
