<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\UnauthorizedException;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role = null, $guard = null)
    {

        $authGuard = app('auth')->guard($guard);

        if ($authGuard->guest()) {
            throw UnauthorizedException::notLoggedIn();
        }

        if (! is_null($role)) {
            $roles = is_array($role)
                ? $role
                : explode('|', $role);
        }

        if ( is_null($role) ) {
            $role = $request->route()->getName();

            $roles = array($role);
        }


        foreach ($roles as $role) {

            if ($authGuard->user()->hasRole($role)) {

                return $next($request);
            }

        }

        return redirect()->route('admin.notAuthoried');

        // throw UnauthorizedException::forRoles($roles);

    }
}
