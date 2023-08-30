<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\StalkerPay\User\Enum\RoleEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAccessChecker
{
    public function handle(Request $request, Closure $next): Response
    {
        /** @var User|null $user */
        $user = Auth::user();
        if (is_null($user)) {
            return redirect()->route('web_index');
        }

        if ($user->role !== RoleEnum::AdminRole->value) {
            return redirect()->route('web_index');
        }

        return $next($request);
    }
}
