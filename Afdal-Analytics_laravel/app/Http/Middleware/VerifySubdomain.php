<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class VerifySubdomain
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
        if (Auth::check()){
            $current_subdomain = Route::input('subdomain');
            $user_subdomain = strtolower(Auth::user()->company->name);
            if ($current_subdomain !== $user_subdomain) {
                return redirect()->to(env('APP_URL'));
            }
            return $next($request);
        }
        return redirect()->to(env('APP_URL') . 'login');
    }
}

