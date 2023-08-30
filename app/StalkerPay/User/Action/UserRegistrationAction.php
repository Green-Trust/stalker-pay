<?php

namespace App\StalkerPay\User\Action;

use App\Mail\UserActivationCodeMail;
use App\Models\User;
use App\StalkerPay\Exception\ApplicationException;
use App\StalkerPay\User\Contract\UserRegistrationDataInterface;
use App\StalkerPay\User\Enum\RoleEnum;
use App\StalkerPay\User\Enum\StatusEnum;
use App\StalkerPay\User\Repository\UserRepositoryInterface;
use App\StalkerPay\User\Service\UserOnlineLogger;
use App\StalkerPay\User\Service\UuidProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserRegistrationAction
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly UuidProvider            $uuidProvider,
        private readonly UserOnlineLogger        $userOnlineLogger
    ) {}

    /**
     * @throws ApplicationException
     */
    public function run(UserRegistrationDataInterface $userRegistrationData): void
    {
        $user = $this->userRepository->getByEmail($userRegistrationData->getEmail());
        if (!is_null($user)) {
            throw new ApplicationException('Почта уже занята');
        }

        $user = $this->userRepository->getByName($userRegistrationData->getName());
        if (!is_null($user)) {
            throw new ApplicationException('Псевдоним уже занят');
        }

        $user           = new User();
        $user->name     = $userRegistrationData->getName();
        $user->email    = $userRegistrationData->getEmail();
        $user->password = Hash::make($userRegistrationData->getPassword());
        $user->avatar   = '/uploads/users/avatars/default.png';
        $user->uuid     = $this->uuidProvider->getNearestAvailable();
        $user->status   = StatusEnum::NotActive->value;
        $user->role     = RoleEnum::UserRole->value;
        $user->save();

        $this->userOnlineLogger->log($user, true);
    }
}
