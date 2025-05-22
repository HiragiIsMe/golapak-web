<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $accessToken = $request->bearerToken();

        $token = PersonalAccessToken::findToken($accessToken);

        if (!$token || !($token->tokenable instanceof User)) {
            return response()->json([
                    'status' => 'error',
                    'message' => 'Access Denied'
                ], 401);
        }


        return $next($request);
    }
}
