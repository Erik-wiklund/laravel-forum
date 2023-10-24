<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdminOrMod
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check() && (auth()->user()->role->name == 'Administrator') || (auth()->user()->role->name == 'Moderator')) {
            return $next($request);
        }

        abort(401, 'You do not have the necessary permissions to access this resource.');
    }
}
