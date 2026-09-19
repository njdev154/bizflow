<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class SocialAuthController extends Controller
{
    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (InvalidStateException $e) {
            return redirect()->route('login')
                ->with('status', "La connexion avec Google a expiré ou a été interrompue. Merci de réessayer.");
        }

        // 1) Ce compte Google a déjà été utilisé ici auparavant
        $user = User::where('google_id', $googleUser->getId())->first();

        // 2) Sinon, un compte existe déjà avec cet email (inscription classique) : on relie les deux
        if (!$user) {
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                $user->update(['google_id' => $googleUser->getId()]);
            }
        }

        // 3) Sinon, tout nouveau compte
        if (!$user) {
            $user = User::create([
                'name' => $googleUser->getName() ?: 'Utilisateur',
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
            ]);
        }

        Auth::login($user, true);

        return redirect()->intended(
            $user->currentOrganization() ? route('dashboard') : route('onboarding.company')
        );
    }
}
