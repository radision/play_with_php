<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;

class MessageController extends BaseController
{

    public function index(Request $request, $id = 0)
    {
        $mobile = $request->session()->get('auth_mobile');
        if (!$mobile)
        {
            return redirect('/');
        }
        $curr_mobile_id = 0;
        if ($mobile)
        {
            $info = unserialize($mobile);
            if ($info->id)
            {
                $curr_mobile_id = $info->id;
            }
        }
        if (!$id)
        {
            $list = DB::table('short_message')
                ->where('parent_id', '=', 0)
                ->where('to_mobile_id', '=', $curr_mobile_id)
                ->get();
        }
        else
        {
            $list = DB::table('short_message')
                ->where('parent_id', '=', $id)
                ->get();
        }
        return view('message.list')->with('list', $list)->with('id', $id);
    }

    public function post(Request $request, $id = 0)
    {
        $mobile = $request->session()->get('auth_mobile');
        if (!$mobile)
        {
            return redirect('/');
        }
        $info = unserialize($mobile);
        $from_mobile_id = $info->id;

        $mobile = intval($request->input('mobile'));
        $content = intval($request->input('content'));

        $row = DB::table('mobile')
            ->where('mobile', '=', $mobile)
            ->first();
        if (!$row)
        {
            DB::table('mobile')->insert(
                ['mobile' => $mobile, 'created_at' => DB::raw('now()')]
            );
            $row = DB::table('mobile')
                ->where('mobile', '=', $mobile)
                ->first();
        }
        $to_mobile_id = $row->id;
        DB::table('short_message')->insert(
            ['parent_id' => $id, 'from_mobile_id' => $from_mobile_id, 'to_mobile_id' => $to_mobile_id, 'content' => $content, 'created_at' => DB::raw('now()')]
        );
        return redirect("/list/{$id}");
    }

}

