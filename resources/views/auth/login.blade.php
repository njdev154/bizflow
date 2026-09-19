<x-guest-layout>
    <h1 class="text-2xl font-bold text-ink mb-1">Bienvenue sur BizFlow</h1>
    <p class="text-muted text-sm mb-6">Connectez-vous à votre espace pour continuer.</p>

    <x-auth-session-status :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Mot de passe" />
            <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div class="flex items-center justify-between mt-4 mb-6">
            <label for="remember_me" class="inline-flex items-center gap-2 text-sm text-muted">
                <input id="remember_me" type="checkbox" class="rounded border-border text-accent focus:ring-accent" name="remember">
                Se souvenir de moi
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-semibold text-accent hover:underline" href="{{ route('password.request') }}">
                    Mot de passe oublié ?
                </a>
            @endif
        </div>

        <x-primary-button>Se connecter</x-primary-button>
    </form>

    <div class="flex items-center gap-3 my-6 text-xs text-muted">
        <div class="flex-1 h-px bg-border"></div>
        ou
        <div class="flex-1 h-px bg-border"></div>
    </div>

    <a href="{{ route('auth.google.redirect') }}"
       class="w-full inline-flex items-center justify-center gap-2 h-11 border border-border rounded-xl font-semibold text-sm text-ink hover:bg-background transition">
        <svg width="18" height="18" viewBox="0 0 48 48">
            <path fill="#FFC107" d="M43.6 20.5H42V20H24v8h11.3C33.8 32.6 29.4 36 24 36c-6.6 0-12-5.4-12-12s5.4-12 12-12c3.1 0 5.8 1.1 8 3l6-6C34.5 5.1 29.6 3 24 3 12.4 3 3 12.4 3 24s9.4 21 21 21 21-9.4 21-21c0-1.4-.2-2.8-.4-4.5z"/>
            <path fill="#FF3D00" d="M6.3 14.7l6.6 4.8C14.6 15.9 18.9 13 24 13c3.1 0 5.8 1.1 8 3l6-6C34.5 5.1 29.6 3 24 3 15.9 3 8.9 7.6 6.3 14.7z"/>
            <path fill="#4CAF50" d="M24 45c5.4 0 10.2-1.8 14-5l-6.5-5.5C29.4 36 24 36 24 36c-5.3 0-9.8-3.4-11.4-8.1l-6.6 5.1C8.9 40.4 15.9 45 24 45z"/>
            <path fill="#1976D2" d="M43.6 20.5H42V20H24v8h11.3c-1 3-3.1 5.5-5.9 7l6.5 5.5C39.1 37.3 45 31 45 24c0-1.4-.2-2.8-.4-4.5z"/>
        </svg>
        Continuer avec Google
    </a>

    <p class="text-center text-sm text-muted mt-6">
        Vous n'avez pas de compte ?
        <a href="{{ route('register') }}" class="text-accent font-semibold hover:underline">Créer un compte</a>
    </p>
</x-guest-layout>
