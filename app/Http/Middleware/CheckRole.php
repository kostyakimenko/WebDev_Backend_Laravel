<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
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
        if (!Auth::check()) {
            return $next($request);
        }

        if (Auth::user()->access === 'blocked') {
            Auth::logout();
            return redirect('/');
        }

        switch (Auth::user()->role) {
            case 'admin':
                return redirect('admin');
            case 'user':
                return redirect('form-review');
        }
    }
}
