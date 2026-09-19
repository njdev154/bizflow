@php
    $hash = md5($alerts->pluck('message')->implode('|'));
@endphp

<div x-data="{
        hash: '{{ $hash }}',
        hasAlerts: {{ $alerts->isNotEmpty() ? 'true' : 'false' }},
        isUnseen: false,
        init() {
            this.isUnseen = this.hasAlerts && localStorage.getItem('bizflow_notif_seen') !== this.hash;
        },
        markSeen() {
            localStorage.setItem('bizflow_notif_seen', this.hash);
            this.isUnseen = false;
        }
     }">

    <button type="button"
            @click="$dispatch('open-modal', 'notifications'); markSeen()"
            class="relative w-10 h-10 rounded-xl border border-border bg-surface flex items-center justify-center text-muted"
            aria-label="Notifications">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/>
            <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
        </svg>

        <template x-if="isUnseen">
            <span class="absolute -top-1 -right-1 flex h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-danger opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-danger"></span>
            </span>
        </template>
    </button>

    <x-modal name="notifications" maxWidth="md">
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-ink">Notifications</h2>
                <button type="button" x-on:click="$dispatch('close')" class="text-muted hover:text-ink" aria-label="Fermer">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            </div>

            @forelse ($alerts as $alert)
                <a href="{{ $alert['url'] }}"
                   class="flex items-start gap-3 py-3 px-2 -mx-2 rounded-lg border-b border-border last:border-0 hover:bg-background">
                    <span class="w-2.5 h-2.5 mt-1.5 rounded-full shrink-0 {{ $alert['type'] === 'danger' ? 'bg-danger' : ($alert['type'] === 'warning' ? 'bg-warning' : 'bg-muted') }}"></span>
                    <span class="text-sm text-ink">{{ $alert['message'] }}</span>
                </a>
            @empty
                <p class="text-sm text-muted text-center py-8">Aucune notification pour le moment.</p>
            @endforelse
        </div>
    </x-modal>
</div>
