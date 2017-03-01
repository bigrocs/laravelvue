<?php

namespace App\Http\Controllers\Admin;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function getLogin()
    {
        view()->share(['metaTitle' => '后台登录']);

        return view('admin.login');
    }
    public function postLogin(Request $request)
    {
        if (Auth::attempt(['email' => $request->username, 'password' => $request->password]) ||
            Auth::attempt(['mobile' => $request->username, 'password' => $request->password]) ||
            Auth::attempt(['name' => $request->username, 'password' => $request->password])) {
            return redirect(route('admin')); //登录成功返回
        } else {
            echo '账号密码错误';
        }
    }
    /**
     * [postLogout 用户退出]
     * @author BigRocs
     * @email    bigrocs@qq.com
     * @DateTime 2017-03-01T11:44:04+0800
     * @return   [type]                   [description]
     */
    public function postLogout()
    {
        $data = [
                    'title'     => '用户退出成功',
                    'message'   => '用户退出成功!',
                    'type'      => 'success',
                ];
        Auth::logout();
        return response()->json($data, 200);

    }
    public function demo()
    {
        echo '登录成功';
    }
}
