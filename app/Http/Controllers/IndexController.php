<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;

class IndexController extends BaseController
{

    public function login(Request $request)
    {
        return view('user.login');
    }

    public function verify(Request $request)
    {

    }

}
