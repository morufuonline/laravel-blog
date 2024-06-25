<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\RoleManagement;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role_col): Response
    {
        $role = $request->user()->controller ? 1 : RoleManagement::where('id', $request->user()->role)->value($role_col);

        if(!$role){
            abort(403);
        }
        return $next($request);
    }
}
