<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
  
    /**
     * If the request is not expecting JSON, then redirect to the login page
     * @param request The incoming request.
     * @return The redirectTo method returns the route('login') value.
     */
    
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
