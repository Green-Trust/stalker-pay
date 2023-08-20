<?php

namespace App\Http\Controllers\WebAjax\Lot\Silver\Show;

use App\Http\Controllers\BaseController;
use App\StalkerPay\Lot\Silver\Repository\SilverLotRepositoryInterface;
use App\UI\Response\JsonResponseFactory;
use Symfony\Component\HttpFoundation\JsonResponse;

class Controller extends BaseController
{
    public function __construct(
        private readonly SilverLotRepositoryInterface $silverLotRepository,
        private readonly JsonResponseFactory          $jsonResponseFactory,
        private readonly SilverLotBuilder             $silverLotBuilder
    ) {}

    public function run(): JsonResponse
    {
        $silverLots = $this->silverLotRepository->get();

        return $this->jsonResponseFactory->success('Silver lots', $this->silverLotBuilder->build($silverLots));
    }
}
