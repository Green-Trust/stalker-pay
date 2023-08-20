<?php

namespace App\StalkerPay\Lot\Silver\Action;

use App\Models\SilverLot;
use App\Repository\LocationRepository;
use App\Repository\ServerRepository;
use App\StalkerPay\Exception\ApplicationException;
use App\StalkerPay\Lot\Enum\StatusEnum as LotStatusEnum;
use App\StalkerPay\User\Enum\StatusEnum as UserStatusEnum;
use App\StalkerPay\Lot\Silver\Contract\SilverLotCreateDataInterface;
use App\StalkerPay\User\Repository\UserRepositoryInterface;

class SilverLotCreateAction
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly LocationRepository      $locationRepository,
        private readonly ServerRepository        $serverRepository
    ) {}

    /**
     * @throws ApplicationException
     */
    public function run(SilverLotCreateDataInterface $data): SilverLot
    {
        if ($data->getMinimum() > $data->getAmount()) {
            throw new ApplicationException('Минимально допустимый объем продажи превышает общий объем продажи');
        }

        $user = $this->userRepository->getById($data->getCreatorId());
        if (is_null($user)) {
            throw new ApplicationException('Пользователь не найден');
        }

        if ($user->status !== UserStatusEnum::Active->value) {
            throw new ApplicationException('Создавать лоты могут только активированные пользователи');
        }

        $location = $this->locationRepository->getById($data->getLocationId());
        if (is_null($location)) {
            throw new ApplicationException('Локация не найдена');
        }

        $server = $this->serverRepository->getById($data->getServerId());
        if (is_null($server)) {
            throw new ApplicationException('Сервер не найден');
        }

        $silverLot              = new SilverLot();
        $silverLot->amount      = $data->getAmount();
        $silverLot->minimum     = $data->getMinimum();
        $silverLot->description = $data->getDescription();
        $silverLot->type        = $data->getType();
        $silverLot->creator_id  = $user->id;
        $silverLot->location_id = $location->id;
        $silverLot->server_id   = $server->id;
        $silverLot->status      = LotStatusEnum::Active->value;
        $silverLot->save();

        return $silverLot;
    }
}
