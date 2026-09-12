<nav x-data="{ open: false }" class="bg-surface border-b border-border">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center gap-8">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 font-bold text-ink">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo BizFlow" class="h-8 w-8">
                    BizFlow
                </a>

                <div class="hidden sm:flex sm:space-x-6">
                      <a href="{{ route('dashboard') }}"
   class="text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-accent' : 'text-muted hover:text-ink' }}">
    Tableau de bord
</a>
<a href="{{ route('clients.index') }}"
   class="text-sm font-medium {{ request()->routeIs('clients.*') ? 'text-accent' : 'text-muted hover:text-ink' }}">
    Clients
</a>
<a href="{{ route('services.index') }}"
   class="text-sm font-medium {{ request()->routeIs('services.*') ? 'text-accent' : 'text-muted hover:text-ink' }}">
    Services
</a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-1 px-3 py-2 text-sm font-medium rounded-xl text-muted hover:text-ink transition">
                            <div class="w-8 h-8 rounded-full bg-accent-light text-warning flex items-center justify-center text-xs font-bold">
                                {{ collect(explode(' ', Auth::user()->name))->map(fn($p) => mb_substr($p, 0, 1))->join('') }}
                            </div>
                            <span class="ms-1">{{ Auth::user()->name }}</span>
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Mon profil
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                Se déconnecter
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-muted hover:text-ink hover:bg-background focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-border">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <a href="{{ route('dashboard') }}"
   class="text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-accent' : 'text-muted hover:text-ink' }}">
    Tableau de bord
</a>
<a href="{{ route('clients.index') }}"
   class="text-sm font-medium {{ request()->routeIs('clients.*') ? 'text-accent' : 'text-muted hover:text-ink' }}">
    Clients
</a>
<a href="{{ route('services.index') }}"
   class="text-sm font-medium {{ request()->routeIs('services.*') ? 'text-accent' : 'text-muted hover:text-ink' }}">
    Services
</a>
        </div>

        <div class="pt-4 pb-3 border-t border-border px-4">
            <div class="font-medium text-sm text-ink">{{ Auth::user()->name }}</div>
            <div class="text-sm text-muted">{{ Auth::user()->email }}</div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('dashboard') }}"
   class="text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-accent' : 'text-muted hover:text-ink' }}">
    Tableau de bord
</a>
<a href="{{ route('clients.index') }}"
   class="text-sm font-medium {{ request()->routeIs('clients.*') ? 'text-accent' : 'text-muted hover:text-ink' }}">
    Clients
</a>
<a href="{{ route('services.index') }}"
   class="text-sm font-medium {{ request()->routeIs('services.*') ? 'text-accent' : 'text-muted hover:text-ink' }}">
    Services
</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block py-2 text-sm text-muted">Se déconnecter</button>
                </form>
            </div>
        </div>
    </div>
</nav>
