<x-guest-layout>
    <h1 class="text-2xl font-bold text-ink mb-1">Mot de passe oublié</h1>
    <p class="text-muted text-sm mb-6">
        Pas de souci. Indiquez votre adresse email, nous vous enverrons un lien pour réinitialiser votre mot de passe.
    </p>

    <x-auth-session-status :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-6">
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <x-primary-button>Envoyer le lien de réinitialisation</x-primary-button>
    </form>

    <p class="text-center text-sm text-muted mt-6">
        <a href="{{ route('login') }}" class="text-accent font-semibold hover:underline">Retour à la connexion</a>
    </p>
</x-guest-layout>
