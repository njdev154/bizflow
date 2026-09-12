@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-success mb-4']) }}>
        {{ $status }}
    </div>
@endif
