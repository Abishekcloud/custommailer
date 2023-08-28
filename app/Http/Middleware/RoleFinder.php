<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleFinder
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check the user's role here and redirect accordingly
        if (auth()->user()->role === 'admin') {
            return $next($request);
            // return redirect()->route('admin.index');
        } elseif (auth()->user()->role === 'user') {
            return redirect()->route('user.index');
        }

        // If the role is not recognized, proceed to the next middleware/route
    }

}
