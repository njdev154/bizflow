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

    <p class="text-center text-sm text-muted mt-6">
        Vous n'avez pas de compte ?
        <a href="{{ route('register') }}" class="text-accent font-semibold hover:underline">Créer un compte</a>
    </p>
</x-guest-layout>
