<?php

namespace App\Http\Controllers\Admin\User\Show;

use App\Http\Controllers\BaseController;
use App\StalkerPay\User\Dto\SearchParam;
use App\StalkerPay\User\Repository\UserRepositoryInterface;
use Illuminate\Contracts\View\View;

class Controller extends BaseController
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly ReportContextBuilder    $reportContextBuilder
    ) {}

    public function run(): View
    {
        return view('admin.user.show', [
            'reportContext' => $this->reportContextBuilder->build(
                $this->userRepository->getAll(new SearchParam())
            ),
        ]);
    }
}
