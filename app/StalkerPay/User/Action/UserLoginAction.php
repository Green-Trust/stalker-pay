<?php

namespace App\StalkerPay\User\Action;

use App\StalkerPay\Exception\ApplicationException;
use App\StalkerPay\User\Contract\UserLoginDataInterface;
use App\StalkerPay\User\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserLoginAction
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {}

    /**
     * @throws ApplicationException
     */
    public function run(UserLoginDataInterface $data): void
    {
        $user = $this->userRepository->getByEmail($data->getEmail());
        if (is_null($user)) {
            throw new ApplicationException('Неверный логин или пароль');
        }

        if (!Hash::check($data->getPassword(), $user->password)) {
            throw new ApplicationException('Неверный логин или пароль');
        }

        Auth::login($user);
    }
}
