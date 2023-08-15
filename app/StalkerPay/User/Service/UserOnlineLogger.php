<?php

namespace App\StalkerPay\User\Service;

use App\Models\User;
use App\Models\UserOnlineLog;
use DateTime;
use Illuminate\Support\Facades\Request;

class UserOnlineLogger
{
    public function log(User $user, bool $autoClose = false): void
    {
        $userOnlineLog             = new UserOnlineLog();
        $userOnlineLog->start      = new DateTime();
        $userOnlineLog->ip_address = Request::ip();

        if ($autoClose) {
            $userOnlineLog->end = new DateTime();
        }

        $userOnlineLog->save();
    }
}
