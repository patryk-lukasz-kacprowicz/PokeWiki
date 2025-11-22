<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;

class ApiSecretKeyAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        $expectedKey = Config::get('api.auth.secret_key');
        $headerKey = $request->header('X-SUPER-SECRET-KEY');

        if (empty($expectedKey)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Internal Server Error: API secret key is missing',
            ])->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        if (empty($headerKey)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized: X-SUPER-SECRET-KEY header is missing',
            ])->setStatusCode(Response::HTTP_UNAUTHORIZED);
        }

        if (!hash_equals($expectedKey, $headerKey)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized: X-SUPER-SECRET-KEY is invalid',
            ])->setStatusCode(Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
