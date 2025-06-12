<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsReaderOrAdmin
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
        $user = Auth::user();
        if ($user && in_array($user->role, ['reader', 'admin'])) {
            return $next($request);
        }

        return redirect('/')->with('error', 'Acesso não autorizado.');
    }
}
