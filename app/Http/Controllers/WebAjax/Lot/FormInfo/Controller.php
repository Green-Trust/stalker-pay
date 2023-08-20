<?php

namespace App\Http\Controllers\WebAjax\Lot\FormInfo;

use App\Http\Controllers\BaseController;
use App\UI\Response\JsonResponseFactory;
use Symfony\Component\HttpFoundation\JsonResponse;

class Controller extends BaseController
{
    public function __construct(
        private readonly FormInfoBuilder     $formInfoBuilder,
        private readonly JsonResponseFactory $jsonResponseFactory
    ) {}

    public function run(): JsonResponse
    {
        return $this->jsonResponseFactory->success(data: $this->formInfoBuilder->build());
    }
}
