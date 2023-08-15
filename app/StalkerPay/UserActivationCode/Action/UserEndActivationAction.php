<?php

namespace App\StalkerPay\UserActivationCode\Action;

use App\StalkerPay\Exception\ApplicationException;
use App\StalkerPay\User\Enum\StatusEnum;
use App\StalkerPay\User\Repository\UserRepositoryInterface;
use App\StalkerPay\UserActivationCode\Contract\UserEndActivationDataInterface;
use App\StalkerPay\UserActivationCode\Repository\UserActivationCodeRepositoryInterface;
use App\StalkerPay\UserActivationCode\Service\UserActivationCodeTtlChecker;

class UserEndActivationAction
{
    public function __construct(
        private readonly UserRepositoryInterface               $userRepository,
        private readonly UserActivationCodeRepositoryInterface $userActivationCodeRepository,
        private readonly UserActivationCodeTtlChecker          $userActivationCodeTtlChecker
    ) {}

    /**
     * @throws ApplicationException
     */
    public function run(UserEndActivationDataInterface $userEndActivationData): void
    {
        $user = $this->userRepository->getById($userEndActivationData->getUserId());
        if (is_null($user)) {
            throw new ApplicationException('Пользователь не найден');
        }

        if ($user !== StatusEnum::NotActive) {
            throw new ApplicationException('Пользователь уже активирован');
        }

        $userActivationCode = $this->userActivationCodeRepository->getByCode($userEndActivationData->getUserId());
        if (is_null($userActivationCode)) {
            throw new ApplicationException('Неверный код активации');
        }

        if ($userActivationCode->user_id !== $user->id) {
            throw new ApplicationException('Неверный код активации');
        }

        if (!$this->userActivationCodeTtlChecker->canActivate($userActivationCode)) {
            throw new ApplicationException('Код подтверждения устарел');
        }

        $user->status = StatusEnum::Active;
        $user->save();

        $userActivationCode->delete();
    }
}
