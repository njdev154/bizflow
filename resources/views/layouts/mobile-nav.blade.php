<nav x-data="{ moreOpen: false }" class="sm:hidden">

    <!-- Barre du bas -->
    <div class="fixed bottom-0 left-0 right-0 bg-surface border-t border-border flex justify-around py-1.5 z-20">
        @php
            $mobileLinks = [
                ['route' => 'dashboard', 'pattern' => 'dashboard', 'label' => 'Tableau', 'icon' => 'M3 3h7v9H3V3zm11 0h7v5h-7V3zm0 9h7v9h-7v-9zM3 16h7v5H3v-5z'],
                ['route' => 'clients.index', 'pattern' => 'clients.*', 'label' => 'Clients', 'icon' => 'M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8z'],
                ['route' => 'appointments.index', 'pattern' => 'appointments.*', 'label' => 'RDV', 'icon' => 'M3 4h18v18H3zM16 2v4M8 2v4M3 10h18'],
            ];
        @endphp

        @foreach ($mobileLinks as $link)
            <a href="{{ route($link['route']) }}"
               class="flex flex-col items-center gap-0.5 px-3 py-1.5 text-[11px] font-medium min-w-[44px]
                      {{ request()->routeIs($link['pattern']) ? 'text-accent' : 'text-muted' }}">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="{{ $link['icon'] }}" />
                </svg>
                {{ $link['label'] }}
            </a>
        @endforeach

        <button @click="moreOpen = true"
                class="flex flex-col items-center gap-0.5 px-3 py-1.5 text-[11px] font-medium min-w-[44px]
                       {{ request()->routeIs(['payments.*', 'reports.*']) ? 'text-accent' : 'text-muted' }}">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <circle cx="12" cy="5" r="1.2" fill="currentColor" stroke="none"/>
                <circle cx="12" cy="12" r="1.2" fill="currentColor" stroke="none"/>
                <circle cx="12" cy="19" r="1.2" fill="currentColor" stroke="none"/>
            </svg>
            Plus
        </button>
    </div>

    <!-- Fond assombri -->
    <div x-show="moreOpen" @click="moreOpen = false" x-transition.opacity
         class="fixed inset-0 bg-black/40 z-30" style="display: none;"></div>

    <!-- Panneau "Plus" -->
    <div x-show="moreOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="translate-y-full"
         x-transition:enter-end="translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="translate-y-0"
         x-transition:leave-end="translate-y-full"
         class="fixed bottom-0 left-0 right-0 bg-surface rounded-t-2xl p-4 pb-8 z-40"
         style="display: none;">
        <div class="w-10 h-1.5 bg-border rounded-full mx-auto mb-4"></div>

        <a href="{{ route('payments.index') }}" class="flex items-center gap-3 py-3 text-sm font-medium {{ request()->routeIs('payments.*') ? 'text-accent' : 'text-ink' }}">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
            Paiements
        </a>
        <a href="{{ route('services.index') }}" class="flex items-center gap-3 py-3 text-sm font-medium {{ request()->routeIs('services.*') ? 'text-accent' : 'text-ink' }}">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="6" cy="6" r="3"/><circle cx="6" cy="18" r="3"/><line x1="20" y1="4" x2="8.12" y2="15.88"/><line x1="14.47" y1="14.48" x2="20" y2="20"/><line x1="8.12" y1="8.12" x2="12" y2="12"/></svg>
            Services
        </a>
        <a href="{{ route('reports.index') }}" class="flex items-center gap-3 py-3 text-sm font-medium {{ request()->routeIs('reports.*') ? 'text-accent' : 'text-ink' }}">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
            Rapports
        </a>
        <a href="{{ route('settings.edit') }}" class="flex items-center gap-3 py-3 text-sm font-medium {{ request()->routeIs('settings.*') ? 'text-accent' : 'text-ink' }}">
    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
    Paramètres
</a>
    </div>
</nav>
