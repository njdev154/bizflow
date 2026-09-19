<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureOrganizationExists
{
    /**
     * Empêche d'accéder aux écrans internes tant que l'utilisateur
     * n'a pas terminé la création de son entreprise (cas d'un compte
     * créé via Google, qui n'a pas encore rempli ces informations).
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user()?->currentOrganization()) {
            return redirect()->route('onboarding.company');
        }

        return $next($request);
    }
}
