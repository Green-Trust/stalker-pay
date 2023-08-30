<?php

namespace App\Http\Controllers\Admin\Index;

use App\Http\Controllers\BaseController;
use Illuminate\View\View;

class Controller extends BaseController
{
    public function run(): View
    {
        return view('admin.index.show');
    }
}
