<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;

class DashController extends Controller
{
    public function __invoke()
    {
        return view('dash.index', get_defined_vars());
    }
}
