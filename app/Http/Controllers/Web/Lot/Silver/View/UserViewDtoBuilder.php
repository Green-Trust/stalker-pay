<?php

namespace App\Http\Controllers\Web\Lot\Silver\View;

use App\Http\Controllers\Web\Lot\Silver\View\Dto\UserViewDto;
use App\Models\User;

class UserViewDtoBuilder
{
    public function build(User $user): UserViewDto
    {
        return (new UserViewDto())
            ->setName($user->name)
            ->setAvatar($user->avatar);
    }
}
