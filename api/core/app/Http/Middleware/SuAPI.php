<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use App\User;

class SuAPI
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
        if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'union.arizona.edu') !== false){
            return $next($request);
        }
        return abort(403, 'Something went wrong.');
    }
}
