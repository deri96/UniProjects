<?php

namespace ASD_Aphrodite\Http\Middleware;

use Closure;

class Admin
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
        if(auth()->user()->tipo_admin == 'admin') {


            return redirect('area_riservata');
        }

        return $next($request);

    }
}
