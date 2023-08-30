<?php

namespace App\StalkerPay\User\Action;

use App\StalkerPay\Exception\ApplicationException;
use App\StalkerPay\User\Contract\UserChangeStatusDataInterface;
use App\StalkerPay\User\Repository\UserRepositoryInterface;

class UserChangeStatusAction
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {}

    /**
     * @throws ApplicationException
     */
    public function run(UserChangeStatusDataInterface $data): void
    {
        $user = $this->userRepository->getById($data->getUserId());
        if (is_null($user)) {
            throw new ApplicationException('Пользователь не найден');
        }

        $user->status = $data->getStatus();
        $user->save();
    }
}
