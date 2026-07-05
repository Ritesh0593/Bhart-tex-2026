<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if custom session flag is set
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login')->with('success', 'Please sign in to access the Admin Panel.');
        }

        return $next($request);
    }
}
