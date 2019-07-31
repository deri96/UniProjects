<?php

namespace ASD_Aphrodite\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AccessoAdmin
{
    public function handle($request, Closure $next)
    {
        if(Auth::check()) {

            if(Auth::user()->tipo_admin == 'admin' || Auth::user()->tipo_admin == 'admin_utente')
                return $next($request);
        }
        return redirect('area_riservata');
    }
}
