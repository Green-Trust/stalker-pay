<?php

namespace App\Http\Controllers\WebAjax\Login;

use App\Http\Controllers\BaseController;
use App\Http\Requests\WebAjax\Login\Request;
use App\StalkerPay\Exception\ApplicationException;
use App\StalkerPay\User\Action\UserLoginAction;
use App\UI\Response\JsonResponseFactory;
use Symfony\Component\HttpFoundation\JsonResponse;

class Controller extends BaseController
{
    public function __construct(
        private readonly UserLoginAction     $userLoginAction,
        private readonly JsonResponseFactory $jsonResponseFactory
    ) {}

    public function run(Request $request): JsonResponse
    {
        try {
            $this->userLoginAction->run($request->getData());
        } catch (ApplicationException $e) {
            return $this->jsonResponseFactory->error($e->getMessage());
        }

        return $this->jsonResponseFactory->success('Login');
    }
}
