<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class Libs
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
        return $next($request);
    }

    public function alert($type, $msg)
    {
        return '<div class="alert alert-'.$type.' mb-1" role="alert">'.$msg.'</div>';
    }
}
