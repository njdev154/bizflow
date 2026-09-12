<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ink">Nouveau rendez-vous</h2>
    </x-slot>

    <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-surface border border-border rounded-xl p-6">

            @if ($clients->isEmpty() || $services->isEmpty())
                <p class="text-sm text-muted">
                    @if ($clients->isEmpty())
                        Vous devez d'abord <a href="{{ route('clients.create') }}" class="text-accent font-semibold hover:underline">ajouter un client</a>.
                    @endif
                    @if ($services->isEmpty())
                        Vous devez d'abord <a href="{{ route('services.create') }}" class="text-accent font-semibold hover:underline">ajouter un service actif</a>.
                    @endif
                </p>
            @else
                <form method="POST" action="{{ route('appointments.store') }}">
                    @csrf

                    <div>
                        <x-input-label for="client_id" value="Client" />
                        <select id="client_id" name="client_id" required
                                class="w-full h-11 px-4 border border-border rounded-xl text-ink focus:outline-none focus:border-accent focus:ring-2 focus:ring-accent/30">
                            <option value="" disabled selected>Sélectionner un client</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}" @selected(old('client_id') == $client->id)>{{ $client->full_name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('client_id')" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="service_id" value="Service" />
                        <select id="service_id" name="service_id" required
                                class="w-full h-11 px-4 border border-border rounded-xl text-ink focus:outline-none focus:border-accent focus:ring-2 focus:ring-accent/30">
                            <option value="" disabled selected>Sélectionner un service</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}" @selected(old('service_id') == $service->id)>
                                    {{ $service->name }} ({{ $service->duration_minutes }} min — {{ number_format($service->price, 0, ',', ' ') }} FCFA)
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('service_id')" />
                    </div>

                    <div class="mt-4 mb-6">
                        <x-input-label for="scheduled_at" value="Date et heure" />
                        <x-text-input id="scheduled_at" type="datetime-local" name="scheduled_at" :value="old('scheduled_at')" required />
                        <x-input-error :messages="$errors->get('scheduled_at')" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button class="w-auto px-6">Créer le rendez-vous</x-primary-button>
                        <a href="{{ route('appointments.index') }}" class="text-sm text-muted hover:text-ink">Annuler</a>
                    </div>
                </form>
            @endif
        </div>
    </div>
</x-app-layout>
