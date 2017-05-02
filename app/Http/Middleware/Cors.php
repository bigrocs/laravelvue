<?php

namespace App\Http\Middleware;

use Closure;

class Cors
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
        $domains = ['http://laravelvue.dev:3000'];
        if (isset($request->server()['HTTP_ORIGIN'])) {
            $origin = $request->server()['HTTP_ORIGIN'];
            if (in_array($origin, $domains)) {
                header('Access-Control-Allow-Origin: '.$origin);
                header('Access-Control-Allow-Credentials: true' );
                header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization,X-Requested-With,X-CSRF-TOKEN,X-XSRF-TOKEN,XMLHttpRequest');  
            }
        }
        return $next($request);
    }
}
