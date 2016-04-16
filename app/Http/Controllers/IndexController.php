<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;

class IndexController extends BaseController
{

    public function login(Request $request)
    {
        $mobile = $request->session()->get('auth_mobile');
        if ($mobile)
        {
            $info = unserialize($mobile);
            if ($info->id)
            {
                return redirect('/list');
            }
        }
        return view('user.login');
    }

    public function verify(Request $request)
    {
        $mobile = intval($request->input('mobile'));

        // 非法手机号
        if (!$mobile)
        {
            return redirect('/');
        }

        // 已存在手机号，设置session，跳转到列表
        $row = DB::table('mobile')
            ->where('mobile', '=', $mobile)
            ->first();
        if ($row)
        {
            $request->session()->set('auth_mobile', serialize($row));
            return redirect('/list');
        }

        // 不存在手机号，添加手机号记录，设置session，跳转到列表
        DB::table('mobile')->insert(
            ['mobile' => $mobile, 'created_at' => DB::raw('now()')]
        );
        $row = DB::table('mobile')
            ->where('mobile', '=', $mobile)
            ->first();
        $request->session()->set('mobile', serialize($row));
        return redirect('/list');
    }

}
