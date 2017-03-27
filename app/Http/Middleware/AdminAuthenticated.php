<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if ($user->hasRole('user')) {
            return $next($request);//登录成功返回
        }else{
            $data = [
                    'title'         => '权限受限',
                    'message'       => '当前用户没有权限访问此页面!',
                    'type'          => 'warning',
                    'notification'  => true,
                ];
            return response()->json($data, 200); 
        }
    }
}
