<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;

class MessageController extends BaseController
{

    public function index(Request $request)
    {
        $curr_mobile_id = 0;
        $mobile = $request->session()->get('oauth_mobile');
        if ($mobile)
        {
            $info = unserialize($mobile);
            if ($info->id)
            {
                $curr_mobile_id = $info->id;
            }
        }
        $list = DB::table('short_message')
            ->where('parent_id', '=', 0)
            ->where('to_mobile_id', '=', $curr_mobile_id)
            ->get();
        return view('message.list')->with('list', $list);
    }

}

