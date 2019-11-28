<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

use Closure;

class CheckUserPermission
{
    public function handle($request, Closure $next, $permission)
    {
        $user = Auth::user();
        if(!$user->hasAnyPermissionEx($permission)) {
            abort(404);
        }

        return $next($request);
    }
}
