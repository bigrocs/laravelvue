<?php

namespace App\Http\Controllers\Api\Admin;
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
    public function Login(Request $request)
    {
        // dd($request->username);
        if (Auth::attempt(['email' => $request->username, 'password' => $request->password]) ||
            Auth::attempt(['mobile' => $request->username, 'password' => $request->password]) ||
            Auth::attempt(['name' => $request->username, 'password' => $request->password])) {
            // $user = Auth::user();
            // dd($user);
            return redirect(route('admin')); //登录成功返回
        } else {
            echo '账号密码错误';
        }
    }
    public function Logout()
    {
        Auth::logout();
    }
    public function demo()
    {
        echo '登录成功';
    }
}
