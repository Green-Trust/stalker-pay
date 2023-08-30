<?php

namespace App\Http\Controllers\AdminAjax\User\ChangeStatus\Active;

use App\Http\Controllers\AdminAjax\User\ChangeStatus\Active\ValueObject\UserChangeStatusData;
use App\Http\Controllers\BaseController;
use App\StalkerPay\Exception\ApplicationException;
use App\StalkerPay\User\Action\UserChangeStatusAction;
use App\UI\Response\JsonResponseFactory;
use Symfony\Component\HttpFoundation\JsonResponse;

class Controller extends BaseController
{
    public function __construct(
        private readonly UserChangeStatusAction $userChangeStatusAction,
        private readonly JsonResponseFactory    $jsonResponseFactory
    ) {}

    public function run(int $userId): JsonResponse
    {
        try {
            $this->userChangeStatusAction->run(new UserChangeStatusData($userId));
        } catch (ApplicationException $e) {
            return $this->jsonResponseFactory->error($e->getMessage());
        }

        return $this->jsonResponseFactory->success('User active');
    }
}
