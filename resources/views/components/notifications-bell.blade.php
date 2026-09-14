<div x-data="{ open: false }" class="relative">
    <button @click="open = !open" @click.outside="open = false" type="button"
            class="relative w-10 h-10 rounded-xl border border-border bg-surface flex items-center justify-center text-muted"
            aria-label="Notifications">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/>
            <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
        </svg>
        @if ($alerts->isNotEmpty())
            <span class="absolute -top-1 -right-1 w-2.5 h-2.5 rounded-full bg-danger"></span>
        @endif
    </button>

    <div x-show="open" x-transition
         class="absolute right-0 mt-2 w-80 bg-surface border border-border rounded-xl shadow-lg z-30 overflow-hidden"
         style="display:none;">
        <div class="px-4 py-3 border-b border-border font-semibold text-sm text-ink">Notifications</div>

        @forelse ($alerts as $alert)
            <a href="{{ $alert['url'] }}" class="flex items-start gap-3 px-4 py-3 border-b border-border last:border-0 hover:bg-background text-sm">
                <span class="w-2 h-2 mt-1.5 rounded-full shrink-0 {{ $alert['type'] === 'danger' ? 'bg-danger' : ($alert['type'] === 'warning' ? 'bg-warning' : 'bg-muted') }}"></span>
                <span class="text-ink">{{ $alert['message'] }}</span>
            </a>
        @empty
            <p class="px-4 py-6 text-center text-sm text-muted">Aucune notification pour l'instant.</p>
        @endforelse
    </div>
</div>
