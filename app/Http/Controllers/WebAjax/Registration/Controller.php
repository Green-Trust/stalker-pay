<?php

namespace App\Http\Controllers\WebAjax\Registration;

use App\Http\Requests\Web\Registration\Request;
use App\StalkerPay\Exception\ApplicationException;
use App\StalkerPay\User\Action\UserRegistrationAction;
use App\UI\Response\JsonResponseFactory;
use Symfony\Component\HttpFoundation\JsonResponse;

class Controller
{
    public function __construct(
        private readonly UserRegistrationAction $userRegistrationAction,
        private readonly JsonResponseFactory    $jsonResponseFactory
    ) {}

    public function run(Request $request): JsonResponse
    {
        try {
            $this->userRegistrationAction->run($request->getData());
        } catch (ApplicationException $e) {
            return $this->jsonResponseFactory->error($e->getMessage());
        }

        return $this->jsonResponseFactory->success('User registered');
    }
}
