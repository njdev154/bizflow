<div>
    <x-input-label for="name" value="Nom de la prestation" />
    <x-text-input id="name" name="name" :value="old('name', $service->name ?? '')" placeholder="Ex : Coupe femme" required autofocus />
    <x-input-error :messages="$errors->get('name')" />
</div>

<div class="grid grid-cols-2 gap-4 mt-4">
    <div>
        <x-input-label for="duration_minutes" value="Durée (minutes)" />
        <x-text-input id="duration_minutes" type="number" min="1" name="duration_minutes" :value="old('duration_minutes', $service->duration_minutes ?? '')" required />
        <x-input-error :messages="$errors->get('duration_minutes')" />
    </div>

    <div>
        <x-input-label for="price" value="Prix (FCFA)" />
        <x-text-input id="price" type="number" min="0" step="1" name="price" :value="old('price', isset($service) ? (int) $service->price : '')" required />
        <x-input-error :messages="$errors->get('price')" />
    </div>
</div>

<div class="mt-4">
    <x-input-label for="category" value="Catégorie (optionnel)" />
    <x-text-input id="category" name="category" :value="old('category', $service->category ?? '')" placeholder="Ex : Coiffure" />
    <x-input-error :messages="$errors->get('category')" />
</div>

<div class="mt-4 mb-6">
    <label class="inline-flex items-center gap-2 text-sm text-ink">
        <input type="checkbox" name="is_active" value="1"
               {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }}
               class="rounded border-border text-accent focus:ring-accent">
        Prestation active (visible lors de la prise de rendez-vous)
    </label>
</div>
