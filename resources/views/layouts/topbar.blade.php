<header class="h-16 bg-surface border-b border-border flex items-center justify-between px-4 sm:px-6 shrink-0">
    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 font-bold text-ink sm:hidden">
        <img src="{{ asset('images/logo.png') }}" alt="Logo BizFlow" class="h-7 w-7">
        BizFlow
    </a>
    <div class="hidden sm:block"></div>

    <div class="flex items-center gap-3">
        <x-notifications-bell />

        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="inline-flex items-center gap-2 px-2 py-1.5 rounded-xl text-sm font-medium text-muted hover:text-ink transition">
                    <div class="w-8 h-8 rounded-full overflow-hidden bg-accent-light text-warning flex items-center justify-center text-xs font-bold shrink-0">
                        @if (Auth::user()->avatarUrl())
                            <img src="{{ Auth::user()->avatarUrl() }}" alt="Photo de profil" class="w-full h-full object-cover">
                        @else
                            {{ Auth::user()->initials() }}
                        @endif
                    </div>
                    <span class="hidden sm:inline">{{ Auth::user()->name }}</span>
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')">Mon profil</x-dropdown-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        Se déconnecter
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</header>   
