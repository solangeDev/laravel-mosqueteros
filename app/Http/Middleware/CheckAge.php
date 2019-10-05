<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;

class CheckAge
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
        
        $edad = Carbon::createFromDate(\Auth::user()->birthday)->age;
        if ($edad <= 17) {
            return abort(401);
        }else{
            return $next($request);
        }
    }
}
