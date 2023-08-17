<?php

namespace App\Http\Controllers\Web\Login;

use App\Http\Controllers\BaseController;
use Illuminate\View\View;

class Controller extends BaseController
{
    public function run(): View
    {
        return view('web.login.show');
    }
}
