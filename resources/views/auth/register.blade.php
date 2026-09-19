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
            <x-input-label for="company_name" value="Nom de l'entreprise" />
            <x-text-input id="company_name" type="text" name="company_name" :value="old('company_name')" placeholder="Ex : Salon Bella" required autofocus />
            <x-input-error :messages="$errors->get('company_name')" />
        </div>

        <div class="mt-4">
            <x-input-label for="sector" value="Secteur d'activité" />
            <select id="sector" name="sector" required
                    class="w-full h-11 px-4 border border-border rounded-xl text-ink focus:outline-none focus:border-accent focus:ring-2 focus:ring-accent/30">
                <option value="" disabled {{ old('sector') ? '' : 'selected' }}>Sélectionner un secteur</option>
                @foreach (['Salon de coiffure', 'Barbers', 'Institut de beauté', 'Photographes', 'Réparateurs', 'Autres services'] as $option)
                    <option value="{{ $option }}" @selected(old('sector') === $option)>{{ $option }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('sector')" />
        </div>

        <div class="mt-4">
            <x-input-label for="name" value="Nom complet" />
            <x-text-input id="name" type="text" name="name" :value="old('name')" placeholder="Votre nom et prénom" required autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <div class="mt-4">
            <x-input-label for="phone" value="Téléphone" />
            <x-text-input id="phone" type="tel" name="phone" :value="old('phone')" placeholder="07 12 34 56 78" required autocomplete="tel" />
            <x-input-error :messages="$errors->get('phone')" />
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
        Déjà un compte ?
        <a href="{{ route('login') }}" class="text-accent font-semibold hover:underline">Se connecter</a>
    </p>
</x-guest-layout>
