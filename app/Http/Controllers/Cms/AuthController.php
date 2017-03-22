<?php

namespace App\Http\Controllers\Cms;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function authCheck()
    {
        if (Auth::check()) {
            $data = [
                    'title'     => '登录状态正常',
                    'message'   => '您访问的页面可能不存在！',
                    'type'      => 'info',
                    'state'     => true
                ];
            return response()->json($data, 200);
        }else{
            $data = [
                    'title'     => '未登录！',
                    'message'   => '未登录正在跳转登录页面请稍后!',
                    'type'      => 'warning',
                    'state'     => false
                ];
            return response()->json($data, 200);
        }
    }
    public function postLogin(Request $request)
    {
        if (Auth::attempt(['email' => $request->username, 'password' => $request->password]) ||
            Auth::attempt(['mobile' => $request->username, 'password' => $request->password]) ||
            Auth::attempt(['name' => $request->username, 'password' => $request->password])) 
        {
            $data = [
                    'title'     => '登录成功',
                    'message'   => '登录已成功正在跳转请稍后!',
                    'type'      => 'success',
                    'state'     => true
                ];
        } else {
            $data = [
                    'title'     => '登录失败',
                    'message'   => '请检查账号密码是否正确!',
                    'type'      => 'error',
                    'state'     => false
                ];
        }
        return response()->json($data, 200);
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
                    'state'     => true
                ];
        Auth::logout();
        return response()->json($data, 200);

    }
}
