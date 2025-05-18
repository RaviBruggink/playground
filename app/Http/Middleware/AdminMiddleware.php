<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated and has admin access
        // For now, we'll just check if they have the direct URL
        // You can modify this later to add proper authentication
        
        return $next($request);
    }
} 