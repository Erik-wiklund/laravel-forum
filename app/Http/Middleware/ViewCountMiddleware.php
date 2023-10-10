<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Thread; // Import your model here
use Illuminate\Support\Facades\Auth;

class ViewCountMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            // User is authenticated, increment the view count
            $threadId = $request->route('thread');

            // Find the thread by ID
            $thread = Thread::findOrFail($threadId);

            // Check if a thread with the given ID exists
            if ($thread) {
                // Increment the view count for this thread
                $thread->incrementViewCount();
            }
        }

        return $next($request);
    }
}
