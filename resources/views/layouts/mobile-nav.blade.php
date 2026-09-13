<nav class="sm:hidden fixed bottom-0 left-0 right-0 bg-surface border-t border-border flex justify-around py-1.5 z-20">
    @php
        $mobileLinks = [
            ['route' => 'dashboard', 'pattern' => 'dashboard', 'label' => 'Tableau', 'icon' => 'M3 3h7v9H3V3zm11 0h7v5h-7V3zm0 9h7v9h-7v-9zM3 16h7v5H3v-5z'],
            ['route' => 'clients.index', 'pattern' => 'clients.*', 'label' => 'Clients', 'icon' => 'M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8z'],
            ['route' => 'appointments.index', 'pattern' => 'appointments.*', 'label' => 'RDV', 'icon' => 'M3 4h18v18H3zM16 2v4M8 2v4M3 10h18'],
            ['route' => 'payments.index', 'pattern' => 'payments.*', 'label' => 'Paiements', 'icon' => 'M1 4h22v16H1zM1 10h22'],
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
</nav>
