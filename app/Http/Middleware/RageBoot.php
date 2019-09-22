<?php

namespace App\Http\Middleware;

use Closure;

class RageBoot
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        // Load the buttons
        \App\Packages\Core\Buttons::load();

        return $next($request);
    }
}
