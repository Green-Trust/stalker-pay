<?php

namespace App\Http\Controllers\Admin\User\Show;

use App\Http\Controllers\Admin\User\Show\Dto\UserViewDto;
use App\Models\User;
use App\StalkerPay\User\Enum\StatusEnum;
use App\UI\Link\LinkData;
use App\UI\User\UserService;

class UserViewDtoBuilder
{
    public function __construct(
        private readonly UserService $userService
    ) {}

    public function build(User $user): UserViewDto
    {
        return (new UserViewDto())
            ->setUuid($user->uuid)
            ->setName($user->name)
            ->setAvatar($user->avatar)
            ->setStatus($this->userService->getStatusLabel($user->status))
            ->setChangeStatusLink($this->buildChangeStatusLink($user));
    }

    private function buildChangeStatusLink(User $user): LinkData
    {
        if ($user->status !== StatusEnum::Banned->value) {
            return new LinkData(
                'Заблокировать',
                route('admin_ajax_user_ban', ['userId' => $user->id]),
                'user-ban'
            );
        }

        return new LinkData(
            'Разблокировать',
            route('admin_ajax_user_active', ['userId' => $user->id]),
            'user-active'
        );
    }
}
