<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }

    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        if (Auth::check() && !Auth::user()->active) {
            Auth::logout();
            return redirect()->route('login')->with('inactive', 'Tu cuenta ha sido deshabilitada. Por favor, contacta al administrador.');
        }

        return $next($request);
    }
}
