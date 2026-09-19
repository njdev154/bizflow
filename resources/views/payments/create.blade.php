<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ink">Enregistrer un paiement</h2>
    </x-slot>

    <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 py-8"
         x-data="{
            appointmentId: '{{ old('appointment_id', $selectedAppointmentId ?? '') }}',
            appointments: {{ $eligibleAppointments->map(fn($a) => [
                'id' => $a->id,
                'client_id' => $a->client_id,
                'price' => (float) $a->service->price,
            ])->values()->toJson() }},
            applyAppointment() {
                if (!this.appointmentId) return;
                const appt = this.appointments.find(a => a.id == this.appointmentId);
                if (appt) {
                    this.$refs.clientSelect.value = appt.client_id;
                    this.$refs.amountInput.value = appt.price;
                }
            }
         }">
        <div class="bg-surface border border-border rounded-xl p-6">

            <form method="POST" action="{{ route('payments.store') }}" data-guard-unsaved>
                @csrf

                <div>
                    <x-input-label for="appointment_id" value="Rendez-vous à encaisser (optionnel)" />
                    <select id="appointment_id" name="appointment_id" x-model="appointmentId" @change="applyAppointment()"
                            class="w-full h-11 px-4 border border-border rounded-xl text-ink focus:outline-none focus:border-accent focus:ring-2 focus:ring-accent/30">
                        <option value="">Aucun — vente directe</option>
                        @foreach ($eligibleAppointments as $appointment)
                            <option value="{{ $appointment->id }}">
                                {{ $appointment->client->full_name ?? 'Client supprimé' }} — {{ $appointment->service->name ?? '' }} ({{ $appointment->scheduled_at->translatedFormat('d M, H:i') }})
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('appointment_id')" />
                    <p class="text-xs text-muted mt-1">Sélectionner un rendez-vous remplit automatiquement le client et le montant.</p>
                </div>

                <div class="mt-4">
                    <x-input-label for="client_id" value="Client" />
                    <select id="client_id" name="client_id" x-ref="clientSelect" required
                            class="w-full h-11 px-4 border border-border rounded-xl text-ink focus:outline-none focus:border-accent focus:ring-2 focus:ring-accent/30">
                        <option value="" disabled selected>Sélectionner un client</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}" @selected(old('client_id') == $client->id)>{{ $client->full_name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('client_id')" />
                </div>

                <div class="mt-4">
                    <x-input-label for="amount" value="Montant (FCFA)" />
                    <x-text-input id="amount" type="number" min="0" step="1" name="amount" x-ref="amountInput" :value="old('amount')" required />
                    <x-input-error :messages="$errors->get('amount')" />
                </div>

                <div class="mt-4">
                    <x-input-label for="method" value="Méthode de paiement" />
                    <select id="method" name="method" required
                            class="w-full h-11 px-4 border border-border rounded-xl text-ink focus:outline-none focus:border-accent focus:ring-2 focus:ring-accent/30">
                        @foreach (['especes' => 'Espèces', 'mobile_money' => 'Mobile Money', 'carte' => 'Carte', 'autre' => 'Autre'] as $value => $label)
                            <option value="{{ $value }}" @selected(old('method') === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('method')" />
                </div>

                <div class="mt-4 mb-6">
                    <x-input-label for="paid_at" value="Date et heure du paiement" />
                    <x-text-input id="paid_at" type="datetime-local" name="paid_at" :value="old('paid_at', now()->format('Y-m-d\TH:i'))" required />
                    <x-input-error :messages="$errors->get('paid_at')" />
                </div>

                <div class="flex items-center gap-4">
                    <x-primary-button class="w-auto px-6">Enregistrer le paiement</x-primary-button>
                    <a href="{{ route('payments.index') }}" class="text-sm text-muted hover:text-ink">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
