<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!in_array(auth()->user()->role->name, $roles)) {
            return response()->json([
                'error' => 'Unauthorized',
                'message' => 'Anda tidak diperkenankan melakukan aksi ini!'
            ], 403);
        }
        return $next($request);
    }
}
