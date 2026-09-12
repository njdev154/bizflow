@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full h-11 px-4 border border-border rounded-xl text-ink placeholder:text-gray-400 focus:outline-none focus:border-accent focus:ring-2 focus:ring-accent/30']) }}>
