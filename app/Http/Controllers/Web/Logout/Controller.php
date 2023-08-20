<?php

namespace App\Http\Controllers\Web\Logout;

use App\Http\Controllers\BaseController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    public function run(): Application|Redirector|RedirectResponse
    {
        if (Auth::user()) {
            Auth::logout();
        }

        return redirect()->route('web_index');
    }
}
