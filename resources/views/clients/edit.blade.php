<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ink">Modifier {{ $client->full_name }}</h2>
    </x-slot>

    <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-surface border border-border rounded-xl p-6">
            <form method="POST" action="{{ route('clients.update', $client) }}">
                @csrf
                @method('PUT')

                @include('clients._form')

                <div class="flex items-center gap-4">
                    <x-primary-button class="w-auto px-6">Enregistrer les modifications</x-primary-button>
                    <a href="{{ route('clients.index') }}" class="text-sm text-muted hover:text-ink">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
