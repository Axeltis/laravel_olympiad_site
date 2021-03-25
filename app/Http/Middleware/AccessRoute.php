<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Policies\UserPolicy;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AccessRoute
{

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @param $policy
     * @param null $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $policy, $role = null)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $parameters = $request->route()->parameters();

            if ($role) $parameters['role'] = $role;
            if ($user->able($policy, $parameters))
                return $next($request);
        }
        return redirect()->route('login');

    }


}
