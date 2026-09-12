<div>
    <x-input-label for="full_name" value="Nom complet" />
    <x-text-input id="full_name" name="full_name" :value="old('full_name', $client->full_name ?? '')" required autofocus />
    <x-input-error :messages="$errors->get('full_name')" />
</div>

<div class="mt-4">
    <x-input-label for="phone" value="Téléphone" />
    <x-text-input id="phone" name="phone" :value="old('phone', $client->phone ?? '')" placeholder="07 12 34 56 78" />
    <x-input-error :messages="$errors->get('phone')" />
</div>

<div class="mt-4">
    <x-input-label for="email" value="Email" />
    <x-text-input id="email" type="email" name="email" :value="old('email', $client->email ?? '')" />
    <x-input-error :messages="$errors->get('email')" />
</div>

<div class="mt-4 mb-6">
    <x-input-label for="notes" value="Notes (optionnel)" />
    <textarea id="notes" name="notes" rows="3"
              class="w-full px-4 py-2 border border-border rounded-xl text-ink focus:outline-none focus:border-accent focus:ring-2 focus:ring-accent/30">{{ old('notes', $client->notes ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('notes')" />
</div>
