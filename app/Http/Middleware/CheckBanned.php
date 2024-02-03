<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class CheckBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if ($user && $user->is_permbanned) {
            auth()->logout();
            $message = 'Your account has been suspended permanently. Please contact the administrator.';
        } elseif ($user && $user->banned_until && now()->lessThan($user->banned_until)) {
            $banned_days = now()->diffInDays($user->banned_until) + 1;
            auth()->logout();

            if ($banned_days <= 7) {
                $message = 'Your account has been suspended for ' . $banned_days . ' ' . Str::plural('day', $banned_days) . '. Please contact the administrator.';
            }
        }

        return isset($message)
            ? redirect()->route('login')->withMessage($message)
            : $next($request);
    }
}
