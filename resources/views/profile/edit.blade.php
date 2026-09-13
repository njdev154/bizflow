<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ink">
            Mon profil
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">
        <div class="bg-surface border border-border rounded-xl p-6">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="bg-surface border border-border rounded-xl p-6">
            @include('profile.partials.update-password-form')
        </div>

        <div class="bg-surface border border-border rounded-xl p-6">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</x-app-layout>
