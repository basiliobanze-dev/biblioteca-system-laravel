<?php

namespace App\Http\Middleware;

use Closure;

class IsLibrarian
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
        if (auth()->check() && auth()->user()->role === 'librarian') {
            return $next($request);
        }

        return redirect('/')->with('error', 'Acesso não autorizado.');
    }
}
