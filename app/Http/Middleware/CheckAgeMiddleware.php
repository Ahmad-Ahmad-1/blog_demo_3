<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAgeMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->age < 18) {
            return response('You must be 18 years or older', 403);
        }
        return $next($request);
    }
}
