<?php

namespace App\Http\Controllers\Web\Lot\Silver\View;

use App\Http\Controllers\BaseController;
use App\StalkerPay\Lot\Silver\Repository\SilverLotRepositoryInterface;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Controller extends BaseController
{
    public function __construct(
        private readonly SilverLotRepositoryInterface $silverLotRepository,
        private readonly SilverLotViewDtoBuilder      $silverLotViewDtoBuilder
    ) {}

    public function run(int $silverLotId): View
    {
        $silverLot = $this->silverLotRepository->getById($silverLotId);
        if (is_null($silverLot)) {
            throw new NotFoundHttpException();
        }

        return view('web.lot.silver.show', [
            'silverLot' => $this->silverLotViewDtoBuilder->build($silverLot),
        ]);
    }
}
