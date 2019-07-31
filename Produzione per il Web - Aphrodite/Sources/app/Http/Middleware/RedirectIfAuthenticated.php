<?php

namespace ASD_Aphrodite\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard) {
            case 'admin':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('area_riservata.home');
                }
                break;
            default:
                if (Auth::guard($guard)->check()) {
                    return redirect('area_riservata.home');
                }
                break;
        }
        return $next($request);
    }
}
