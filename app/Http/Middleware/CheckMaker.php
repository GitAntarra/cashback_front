<?php

namespace App\Http\Middleware;

use Closure;

class checkMaker
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
        // $value = $request->session()->get('isLogin');
        $isLogin = $request->session()->get('set_userdata');
        
        if($isLogin['level'] != "MAKER" || $isLogin['level'] == 'SUPERADMIN'){
            abort(403);
        }
        return $next($request);
    }
}
