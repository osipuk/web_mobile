<?php

namespace App\Http\Middleware;

use PDO;
use Config;
use Closure;
use Illuminate\Support\Facades\Auth;

class ConfigureMultiTenantDB
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::User()){
            if(isset(Auth::User()->database_name) && !empty(Auth::User()->database_name)){
                makeDBConnection(Auth::User()->database_name);
            }
        }
        return $next($request);
    }
}
