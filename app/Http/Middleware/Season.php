<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Season
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
        if (session()->has('season')) {
            session()->get('season');
        }
        else { // This is optional as Laravel will automatically set the fallback season if there is none specified
            session()->put('season', date('Y'));
        }
        return $next($request);
    }
}
