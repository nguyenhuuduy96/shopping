<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CheckIsActive
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
        if(Auth::user()->is_active < 2 ){
            return redirect(route('check'));
        }
        return $next($request);
    }
}
