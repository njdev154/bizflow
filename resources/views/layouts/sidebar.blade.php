<aside class="hidden sm:flex sm:flex-col bg-primary text-white px-3 lg:px-4 py-5 shrink-0">
    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 font-bold px-2 mb-6">
        <img src="{{ asset('images/logo.png') }}" alt="Logo BizFlow" class="h-7 w-7 shrink-0">
        <span class="hidden lg:inline">BizFlow</span>
    </a>

    <nav class="flex flex-col gap-1">
        @php
            $links = [
    ['route' => 'dashboard', 'pattern' => 'dashboard', 'label' => 'Tableau de bord', 'icon' => 'M3 3h7v9H3V3zm11 0h7v5h-7V3zm0 9h7v9h-7v-9zM3 16h7v5H3v-5z'],
    ['route' => 'clients.index', 'pattern' => 'clients.*', 'label' => 'Clients', 'icon' => 'M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75'],
    ['route' => 'services.index', 'pattern' => 'services.*', 'label' => 'Services', 'icon' => 'M6 6a3 3 0 1 0 0 6 3 3 0 0 0 0-6zM6 18a3 3 0 1 0 0 6 3 3 0 0 0 0-6zM20 4L8.12 15.88M14.47 14.48L20 20M8.12 8.12L12 12'],
    ['route' => 'appointments.index', 'pattern' => 'appointments.*', 'label' => 'Rendez-vous', 'icon' => 'M3 4h18v18H3zM16 2v4M8 2v4M3 10h18'],
    ['route' => 'payments.index', 'pattern' => 'payments.*', 'label' => 'Paiements', 'icon' => 'M1 4h22v16H1zM1 10h22'],
    ['route' => 'reports.index', 'pattern' => 'reports.*', 'label' => 'Rapports', 'icon' => 'M18 20V10M12 20V4M6 20v-6'],
];
        @endphp

        @foreach ($links as $link)
            <a href="{{ route($link['route']) }}"
               title="{{ $link['label'] }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition
                      {{ request()->routeIs($link['pattern'])
                            ? 'bg-accent text-primary-dark font-semibold'
                            : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-[18px] h-[18px] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="{{ $link['icon'] }}" />
                </svg>
                <span class="hidden lg:inline whitespace-nowrap">{{ $link['label'] }}</span>
            </a>
        @endforeach
    </nav>
</aside>
