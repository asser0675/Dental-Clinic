<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Role
{
    public function handle(Request $request, Closure $next, string ...$roles)
    {
        abort_unless(auth()->check() && in_array(auth()->user()->role, $roles, true), 403);

        return $next($request);
    }
}
