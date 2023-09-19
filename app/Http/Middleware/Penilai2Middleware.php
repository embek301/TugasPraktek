<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Penilai2Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is a Penilai 2
        if (auth()->user()->penilai2s()->exists()) {
            return $next($request);
        }

        // Redirect to a no-access page or do other actions as needed
        return redirect()->route('no-access');
    }
}
