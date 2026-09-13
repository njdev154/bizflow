<aside class="hidden sm:flex sm:flex-col bg-primary text-white px-3 lg:px-4 py-5 shrink-0">
    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 font-bold px-2 mb-6">
        <img src="{{ asset('images/logo.png') }}" alt="Logo BizFlow" class="h-7 w-7 shrink-0">
        <span class="hidden lg:inline">BizFlow</span>
    </a>

    <nav class="flex flex-col gap-1">
        @php
            $isOwner = auth()->user()->roleIn(auth()->user()->currentOrganization()) === 'owner';

            $links = [
                ['route' => 'dashboard', 'pattern' => 'dashboard', 'label' => 'Tableau de bord', 'icon' => 'M3 3h7v9H3V3zm11 0h7v5h-7V3zm0 9h7v9h-7v-9zM3 16h7v5H3v-5z', 'ownerOnly' => false],
                ['route' => 'clients.index', 'pattern' => 'clients.*', 'label' => 'Clients', 'icon' => 'M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75', 'ownerOnly' => false],
                ['route' => 'services.index', 'pattern' => 'services.*', 'label' => 'Services', 'icon' => 'M6 6a3 3 0 1 0 0 6 3 3 0 0 0 0-6zM6 18a3 3 0 1 0 0 6 3 3 0 0 0 0-6zM20 4L8.12 15.88M14.47 14.48L20 20M8.12 8.12L12 12', 'ownerOnly' => false],
                ['route' => 'appointments.index', 'pattern' => 'appointments.*', 'label' => 'Rendez-vous', 'icon' => 'M3 4h18v18H3zM16 2v4M8 2v4M3 10h18', 'ownerOnly' => false],
                ['route' => 'payments.index', 'pattern' => 'payments.*', 'label' => 'Paiements', 'icon' => 'M1 4h22v16H1zM1 10h22', 'ownerOnly' => false],
                ['route' => 'employees.index', 'pattern' => 'employees.*', 'label' => 'Employés', 'icon' => 'M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2M12 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8z', 'ownerOnly' => true],
                ['route' => 'reports.index', 'pattern' => 'reports.*', 'label' => 'Rapports', 'icon' => 'M18 20V10M12 20V4M6 20v-6', 'ownerOnly' => false],
                ['route' => 'settings.edit', 'pattern' => 'settings.*', 'label' => 'Paramètres', 'icon' => 'M12 8a4 4 0 1 0 0 8 4 4 0 0 0 0-8zM19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z', 'ownerOnly' => false],
            ];
        @endphp

        @foreach ($links as $link)
            @if (!$link['ownerOnly'] || $isOwner)
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
            @endif
        @endforeach
    </nav>
</aside>
