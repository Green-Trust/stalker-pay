<?php

namespace App\Http\Controllers\Web\Registration;

use App\Http\Controllers\BaseController;
use Illuminate\View\View;

class Controller extends BaseController
{
    public function run(): View
    {
        return view('web.registration.show');
    }
}
