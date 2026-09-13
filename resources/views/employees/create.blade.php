<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ink">Ajouter un employé</h2>
    </x-slot>

    <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-surface border border-border rounded-xl p-6">

            <p class="text-sm text-muted mb-6">
                Vous créez un compte de connexion pour cette personne. Communiquez-lui son email et le mot de passe temporaire ci-dessous — elle pourra le modifier ensuite depuis son profil.
            </p>

            <form method="POST" action="{{ route('employees.store') }}">
                @csrf

                <div>
                    <x-input-label for="name" value="Nom complet" />
                    <x-text-input id="name" name="name" :value="old('name')" required autofocus />
                    <x-input-error :messages="$errors->get('name')" />
                </div>

                <div class="mt-4">
                    <x-input-label for="email" value="Email" />
                    <x-text-input id="email" type="email" name="email" :value="old('email')" required />
                    <x-input-error :messages="$errors->get('email')" />
                </div>

                <div class="mt-4">
                    <x-input-label for="password" value="Mot de passe temporaire" />
                    <x-text-input id="password" type="text" name="password" :value="old('password')" required minlength="8" />
                    <x-input-error :messages="$errors->get('password')" />
                </div>

                <div class="mt-4 mb-6">
                    <x-input-label for="role" value="Rôle" />
                    <select id="role" name="role" required
                            class="w-full h-11 px-4 border border-border rounded-xl text-ink focus:outline-none focus:border-accent focus:ring-2 focus:ring-accent/30">
                        <option value="employee" @selected(old('role') === 'employee')>Employé — accès limité</option>
                        <option value="manager" @selected(old('role') === 'manager')>Manager — accès large</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" />
                </div>

                <div class="flex items-center gap-4">
                    <x-primary-button class="w-auto px-6">Créer le compte</x-primary-button>
                    <a href="{{ route('employees.index') }}" class="text-sm text-muted hover:text-ink">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
