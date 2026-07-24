<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Vérifier si l'utilisateur est connecté
        if (!$request->user()) {
            return response()->json([
                'message' => 'Non authentifié.'
            ], 401);
        }

        // Vérifier le rôle
        if ($request->user()->role !== $role) {
            return response()->json([
                'message' => 'Accès refusé.'
            ], 403);
        }

        return $next($request);
    }
}