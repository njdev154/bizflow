@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-semibold text-ink mb-2']) }}>
    {{ $value ?? $slot }}
</label>
