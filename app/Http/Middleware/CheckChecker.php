<?php

namespace App\Http\Middleware;

use Closure;

class CheckChecker
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
        
        // if(isset($isLogin) && ($isLogin['level'] != "MAKER" || $isLogin != "CHECKER" || $isLogin != "SUPERADMIN")){
        //     abort(403);
        // }else 
        if(!$isLogin){
            return redirect('/auth-login');
        }
        return $next($request);
    }
}
