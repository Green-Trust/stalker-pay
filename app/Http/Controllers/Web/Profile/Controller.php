<?php

namespace App\Http\Controllers\Web\Profile;

use App\Http\Controllers\BaseController;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    public function __construct(
        private readonly ProfileViewDtoBuilder $profileViewDtoBuilder
    ) {}

    public function run(): View
    {
        /** @var User $user */
        $user = Auth::user();

        return view('web.profile.show', [
            'profileViewDto' => $this->profileViewDtoBuilder->build($user),
        ]);
    }
}
