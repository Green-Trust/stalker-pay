<?php

namespace App\Http\Controllers\Web\Profile;

use App\Http\Controllers\Web\Profile\Dto\ProfileViewDto;
use App\Models\User;

class ProfileViewDtoBuilder
{
    public function build(User $user): ProfileViewDto
    {
        return (new ProfileViewDto())
            ->setName($user->name)
            ->setAvatar($user->avatar)
            ->setUuid($user->uuid)
            ->setUuidColor($this->uuidColorMapper($user->uuid))
            ->setRegistrationDate($user->created_at->format('d.m.Y'))
            ->setLogoutUrl(route('web_logout'));
    }

    private function uuidColorMapper(int $uuid): string
    {
        if ($uuid <= 10) {
            return '#04ff00';
        }

        if ($uuid <= 100) {
            return '#3c94ef';
        }

        return '#a3a3a3';
    }
}
