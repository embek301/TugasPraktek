<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user() && auth()->user()->hak == 10) {
            return $next($request);
        }

        return redirect('/');
    }
}
