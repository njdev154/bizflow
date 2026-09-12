<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ink">Ajouter un client</h2>
    </x-slot>

    <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-surface border border-border rounded-xl p-6">
            <form method="POST" action="{{ route('clients.store') }}">
                @csrf

                <div>
                    <x-input-label for="full_name" value="Nom complet" />
                    <x-text-input id="full_name" name="full_name" :value="old('full_name')" required autofocus />
                    <x-input-error :messages="$errors->get('full_name')" />
                </div>

                <div class="mt-4">
                    <x-input-label for="phone" value="Téléphone" />
                    <x-text-input id="phone" name="phone" :value="old('phone')" placeholder="07 12 34 56 78" />
                    <x-input-error :messages="$errors->get('phone')" />
                </div>

                <div class="mt-4">
                    <x-input-label for="email" value="Email" />
                    <x-text-input id="email" type="email" name="email" :value="old('email')" />
                    <x-input-error :messages="$errors->get('email')" />
                </div>

                <div class="mt-4 mb-6">
                    <x-input-label for="notes" value="Notes (optionnel)" />
                    <textarea id="notes" name="notes" rows="3"
                              class="w-full px-4 py-2 border border-border rounded-xl text-ink focus:outline-none focus:border-accent focus:ring-2 focus:ring-accent/30">{{ old('notes') }}</textarea>
                    <x-input-error :messages="$errors->get('notes')" />
                </div>

                <div class="flex items-center gap-4">
                    <x-primary-button class="w-auto px-6">Enregistrer le client</x-primary-button>
                    <a href="{{ route('clients.index') }}" class="text-sm text-muted hover:text-ink">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
