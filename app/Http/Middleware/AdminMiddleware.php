<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Logique de vérification de l'administrateur
        // Par exemple, si le user est authentifié et a le rôle "admin"

        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        // Redirigez vers une autre page ou renvoyez une réponse d'erreur pour les utilisateurs non autorisés
        return redirect('/')->with('error', 'Accès refusé. Vous devez être un administrateur pour accéder à cette page.');
        
    }
}
