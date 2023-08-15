<?php

namespace App\StalkerPay\UserActivationCode\Action;

use App\Mail\UserActivationCodeMail;
use App\Models\User;
use App\StalkerPay\Exception\ApplicationException;
use App\StalkerPay\User\Enum\StatusEnum;
use App\StalkerPay\UserActivationCode\Repository\UserActivationCodeRepositoryInterface;
use App\StalkerPay\UserActivationCode\Service\UserActivationCodeGenerator;
use App\StalkerPay\UserActivationCode\Service\UserActivationCodeTtlChecker;
use Illuminate\Support\Facades\Mail;

class UserStartActivationAction
{
    public function __construct(
        private readonly UserActivationCodeGenerator           $activationCodeGenerator,
        private readonly UserActivationCodeRepositoryInterface $userActivationCodeRepository,
        private readonly UserActivationCodeTtlChecker          $userActivationCodeTtlChecker
    ) {}

    /**
     * @throws ApplicationException
     */
    public function run(User $user): void
    {
        if ($user->status !== StatusEnum::NotActive->value) {
            throw new ApplicationException('Пользователь уже активирован');
        }

        $userActivationCode = $this->userActivationCodeRepository->getByUser($user);
        if (!is_null($userActivationCode)) {
            if ($this->userActivationCodeTtlChecker->canReply($userActivationCode)) {
                $userActivationCode->delete();
            } else {
                throw new ApplicationException('Вы не можете повторно отправить код - пожалуйста подождите');
            }
        }

        $userActivationCode = $this->activationCodeGenerator->generate($user);
        Mail::to($user->email)->send(new UserActivationCodeMail($userActivationCode));
    }
}
