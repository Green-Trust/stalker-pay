<?php

namespace App\Http\Controllers\WebAjax\Lot\Silver\Create;

use App\Http\Controllers\BaseController;
use App\Http\Requests\WebAjax\Lot\Silver\Create\Request;
use App\StalkerPay\Exception\ApplicationException;
use App\StalkerPay\Lot\Silver\Action\SilverLotCreateAction;
use App\UI\Response\JsonResponseFactory;
use Symfony\Component\HttpFoundation\JsonResponse;

class Controller extends BaseController
{
    public function __construct(
        private readonly SilverLotCreateAction $silverLotCreateAction,
        private readonly JsonResponseFactory   $jsonResponseFactory
    ) {}

    public function run(Request $request): JsonResponse
    {
        $data = $request->getData();

        try {
            $silverLot = $this->silverLotCreateAction->run($data);
        } catch (ApplicationException $e) {
            return $this->jsonResponseFactory->error($e->getMessage());
        }

        return $this->jsonResponseFactory->success('Silver lot created', [
            'id' => $silverLot->id,
        ]);
    }
}
