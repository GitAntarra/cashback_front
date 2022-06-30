<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class CheckLogin
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
        
        if($isLogin['level'] != "SUPERADMIN"){
            abort(403);
            // Session::flash('info', 'welcome baby');
            // return redirect('/logout');
        }
        return $next($request);
    }
}
