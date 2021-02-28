<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Policies\UserPolicy;
use Closure;
use Illuminate\Http\Request;



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
        $user = $request->user();
        $parameters = $request->route()->parameters();

        if ($role) $parameters['role'] = $role;
        if($user->able($policy, $parameters))
            return $next($request);
        abort(403);
    }



}
