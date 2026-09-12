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

    <p class="text-center text-sm text-muted mt-6">
        Déjà un compte ?
        <a href="{{ route('login') }}" class="text-accent font-semibold hover:underline">Se connecter</a>
    </p>
</x-guest-layout>
