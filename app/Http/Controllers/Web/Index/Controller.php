<?php

namespace App\Http\Controllers\Web\Index;

use App\Http\Controllers\BaseController;
use Illuminate\View\View;

class Controller extends BaseController
{
    public function run(): View
    {
        return view('web.index.show');
    }
}
