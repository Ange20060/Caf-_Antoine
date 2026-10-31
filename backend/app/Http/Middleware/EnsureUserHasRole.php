<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use App\UserRole as AppUserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
      $user = $request ->user();

      if(!$user){
        return response()->json([
          'message'=> 'unauthentificate',
        ],401);
      }

      $allowRole = array_map(
        fn (string $role) => AppUserRole::tryFrom($role),
        $roles
      );

      if(!in_array($user ->role, $allowRole, true)){
        return response()->json([
          'message' =>'Access denied',
        ],403);
      }
        return $next($request);
    }
}
