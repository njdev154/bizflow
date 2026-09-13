<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ink">Paramètres de l'entreprise</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-surface border border-border rounded-xl p-6">

            <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Logo -->
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-16 h-16 rounded-xl bg-background border border-border flex items-center justify-center overflow-hidden shrink-0">
                        @if ($organization->logo_path)
                            <img src="{{ Storage::url($organization->logo_path) }}" alt="Logo" class="w-full h-full object-contain">
                        @else
                            <span class="text-xs text-muted">Aucun</span>
                        @endif
                    </div>
                    <div>
                        <x-input-label for="logo" value="Logo de l'entreprise" />
                        <input type="file" id="logo" name="logo" accept="image/*"
                               class="text-sm text-muted file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-accent-light file:text-warning file:text-sm file:font-semibold">
                        <x-input-error :messages="$errors->get('logo')" />
                    </div>
                </div>

                <div>
                    <x-input-label for="name" value="Nom de l'entreprise" />
                    <x-text-input id="name" name="name" :value="old('name', $organization->name)" required />
                    <x-input-error :messages="$errors->get('name')" />
                </div>

                <div class="mt-4">
                    <x-input-label for="sector" value="Secteur d'activité" />
                    <select id="sector" name="sector" required
                            class="w-full h-11 px-4 border border-border rounded-xl text-ink focus:outline-none focus:border-accent focus:ring-2 focus:ring-accent/30">
                        @foreach (['Salon de coiffure', 'Barbers', 'Institut de beauté', 'Photographes', 'Réparateurs', 'Autres services'] as $option)
                            <option value="{{ $option }}" @selected(old('sector', $organization->sector) === $option)>{{ $option }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('sector')" />
                </div>

                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div>
                        <x-input-label for="phone" value="Téléphone" />
                        <x-text-input id="phone" name="phone" :value="old('phone', $organization->phone)" />
                        <x-input-error :messages="$errors->get('phone')" />
                    </div>
                    <div>
                        <x-input-label for="email" value="Email de contact" />
                        <x-text-input id="email" type="email" name="email" :value="old('email', $organization->email)" />
                        <x-input-error :messages="$errors->get('email')" />
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mt-4 mb-6">
                    <div>
                        <x-input-label for="currency" value="Devise" />
                        <select id="currency" name="currency" required
                                class="w-full h-11 px-4 border border-border rounded-xl text-ink focus:outline-none focus:border-accent focus:ring-2 focus:ring-accent/30">
                            @foreach (['FCFA' => 'Franc CFA (FCFA)', 'EUR' => 'Euro (€)', 'USD' => 'Dollar US ($)'] as $value => $label)
                                <option value="{{ $value }}" @selected(old('currency', $organization->currency) === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('currency')" />
                    </div>
                    <div>
                        <x-input-label for="timezone" value="Fuseau horaire" />
                        <select id="timezone" name="timezone" required
                                class="w-full h-11 px-4 border border-border rounded-xl text-ink focus:outline-none focus:border-accent focus:ring-2 focus:ring-accent/30">
                            @foreach (['Africa/Abidjan' => 'Abidjan (GMT)', 'Africa/Dakar' => 'Dakar (GMT)', 'Europe/Paris' => 'Paris (GMT+1/+2)'] as $value => $label)
                                <option value="{{ $value }}" @selected(old('timezone', $organization->timezone) === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('timezone')" />
                    </div>
                </div>

                <x-primary-button class="w-auto px-6">Enregistrer les modifications</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
