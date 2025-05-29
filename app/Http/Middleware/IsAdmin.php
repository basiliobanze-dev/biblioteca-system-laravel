<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    
    // public function handle($request, Closure $next)
    // {
    //     if (auth()->check() && auth()->user()->role === 'admin') {
    //         return $next($request);
    //     }

    //     return redirect('/')->with('error', 'Acesso não autorizado.');
    // }
    
    public function handle($request, Closure $next)
    {
        if (auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role === 'librarian')) {
            return $next($request);
        }

        abort(403, 'Acesso não autorizado.');
    }

}
