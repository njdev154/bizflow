<x-guest-layout>
    <x-slot:aside>
        <h2 class="text-2xl font-bold mb-4">Gérez facilement votre activité</h2>
        <p class="text-white/70 mb-6">Tout ce dont votre entreprise a besoin, réuni au même endroit.</p>
        <ul class="space-y-3">
            @foreach (['Clients', 'Rendez-vous', 'Paiements', 'Services', 'Rapports', 'Multi-utilisateurs'] as $item)
                <li class="flex items-center gap-3">
                    <span class="w-6 h-6 rounded-full bg-accent/20 text-accent flex items-center justify-center text-sm">✓</span>
                    {{ $item }}
                </li>
            @endforeach
        </ul>
    </x-slot:aside>

    <h1 class="text-2xl font-bold text-ink mb-1">Créer votre compte</h1>
    <p class="text-muted text-sm mb-6">Rejoignez des milliers de professionnels.</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-input-label for="name" value="Nom complet" />
            <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Mot de passe" />
            <x-text-input id="password" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div class="mt-4 mb-6">
            <x-input-label for="password_confirmation" value="Confirmer le mot de passe" />
            <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <x-primary-button>Créer mon compte</x-primary-button>
    </form>

    <p class="text-center text-sm text-muted mt-6">
        Déjà un compte ?
        <a href="{{ route('login') }}" class="text-accent font-semibold hover:underline">Se connecter</a>
    </p>
</x-guest-layout>
