<?php

namespace App\Http\Controllers\Admin\User\Show;

use App\Http\Controllers\Admin\User\Show\Dto\ReportContext;
use Illuminate\Pagination\LengthAwarePaginator;

class ReportContextBuilder
{
    public function __construct(
        private readonly UserViewDtoBuilder $userViewDtoBuilder
    ) {}

    public function build(LengthAwarePaginator $paginator): ReportContext
    {
        $reportContext = new ReportContext();
        $reportContext->setLinks($paginator->links());

        $dtoList = [];
        foreach ($paginator as $user) {
            $dtoList[] = $this->userViewDtoBuilder->build($user);
        }

        $reportContext->setUsers($dtoList);

        return $reportContext;
    }
}
