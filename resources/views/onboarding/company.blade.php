<x-guest-layout>
    <h1 class="text-2xl font-bold text-ink mb-1">Encore une étape</h1>
    <p class="text-muted text-sm mb-6">Dites-nous en un peu plus sur votre entreprise pour finaliser votre compte.</p>

    <form method="POST" action="{{ route('onboarding.company.store') }}" data-guard-unsaved>
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

        <div class="mt-4 mb-6">
            <x-input-label for="phone" value="Téléphone" />
            <x-text-input id="phone" type="tel" name="phone" :value="old('phone')" placeholder="07 12 34 56 78" required autocomplete="tel" />
            <x-input-error :messages="$errors->get('phone')" />
        </div>

        <x-primary-button>Terminer la création de mon compte</x-primary-button>
    </form>
</x-guest-layout>
