<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!$request->user()) {
            return redirect()->route('login');
        }

        $userRole = $request->user()->role instanceof UserRole 
            ? $request->user()->role->value 
            : (string) ($request->user()->role ?? 'talent');
        
        $userRoles = array_filter(array_unique(array_merge(
            (array) ($request->user()->roles ?? []),
            [$userRole]
        )));

        foreach ($roles as $role) {
            if (in_array($role, $userRoles)) {
                return $next($request);
            }
        }

        abort(403, 'Unauthorized access.');
    }
}

