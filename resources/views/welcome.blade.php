<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <title>{{ config('app.name', 'BizFlow') }} — Gérez votre entreprise de services simplement</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-ink antialiased bg-background">

    <!-- ============ HEADER ============ -->
    <header class="bg-surface border-b border-border sticky top-0 z-10">
        <div class="max-w-7xl mx-auto px-6 h-[72px] flex items-center justify-between">
            <a href="/" class="flex items-center gap-2 font-bold text-lg">
                <img src="{{ asset('images/logo.png') }}" alt="Logo BizFlow" class="h-8 w-8">
                BizFlow
            </a>
            <nav class="hidden md:flex gap-8 text-sm text-muted">
                <a href="#" class="hover:text-ink">Accueil</a>
                <a href="#fonctionnalites" class="hover:text-ink">Fonctionnalités</a>
                <a href="#" class="hover:text-ink">Tarifs</a>
                <a href="#" class="hover:text-ink">À propos</a>
            </nav>
            <div class="flex items-center gap-3">
                <a href="{{ route('login') }}" class="hidden sm:inline text-sm font-medium text-muted hover:text-ink">Se connecter</a>
                <a href="{{ route('register') }}" class="inline-flex items-center h-10 px-4 bg-accent text-primary-dark rounded-xl font-semibold text-sm hover:bg-[#E08C00] transition">
                    Créer un compte
                </a>
            </div>
        </div>
    </header>

    <!-- ============ HERO ============ -->
    <section class="bg-primary text-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 py-16 lg:py-20 grid grid-cols-1 lg:grid-cols-[1.1fr_0.9fr] gap-10 items-center">
            <div>
                <h1 class="text-3xl sm:text-4xl font-bold leading-tight mb-4">
                    Gérez votre entreprise de services <span class="text-accent">simplement</span> et efficacement
                </h1>
                <p class="text-white/70 text-lg mb-6 max-w-md">
                    BizFlow vous aide à gérer vos clients, vos rendez-vous, vos paiements et bien plus encore. Concentrez-vous sur votre métier, on s'occupe du reste.
                </p>
                <div class="flex flex-wrap gap-3 mb-6">
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center h-11 px-5 bg-accent text-primary-dark rounded-xl font-semibold text-sm hover:bg-[#E08C00] transition">
                        Commencer gratuitement
                    </a>
                    <a href="#fonctionnalites" class="inline-flex items-center justify-center h-11 px-5 bg-transparent border border-white/30 text-white rounded-xl font-semibold text-sm hover:bg-white/10 transition">
                        Découvrir le produit
                    </a>
                </div>
                <div class="inline-flex items-center gap-2 bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-sm">
                    <span class="text-white/70">Déjà utilisé par</span>
                    <strong class="text-accent">+2000 entreprises</strong>
                </div>
            </div>

            <div class="relative hidden lg:block aspect-[4/3] rounded-xl border border-white/10 overflow-hidden">
                <div class="absolute inset-0" style="background: linear-gradient(160deg, rgba(245,158,11,0.18), rgba(255,255,255,0.04));"></div>
                <div class="absolute inset-0 flex items-center justify-center p-6 text-center text-xs text-white/40">
                    Emplacement réservé — photo d'une professionnelle en activité
                </div>
            </div>
        </div>
    </section>

    <!-- ============ MÉTIERS ============ -->
    <section class="max-w-7xl mx-auto px-6 py-12">
        <h2 class="text-sm font-semibold text-muted uppercase tracking-wide mb-5">Adapté à tous les métiers</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
            @foreach ([
                ['label' => 'Salon de coiffure', 'icon' => 'M6 6a3 3 0 1 0 0 6 3 3 0 0 0 0-6zM6 18a3 3 0 1 0 0 6 3 3 0 0 0 0-6zM20 4L8.12 15.88M14.47 14.48L20 20M8.12 8.12L12 12'],
                ['label' => 'Barbers', 'icon' => 'M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2M12 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8z'],
                ['label' => 'Institut de beauté', 'icon' => 'M20 5h-3.17L15 3H9L7.17 5H4a1 1 0 0 0-1 1v13a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1zM12 17a4 4 0 1 0 0-8 4 4 0 0 0 0 8z'],
                ['label' => 'Photographes', 'icon' => 'M20 5h-3.17L15 3H9L7.17 5H4a1 1 0 0 0-1 1v13a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1zM12 17a4 4 0 1 0 0-8 4 4 0 0 0 0 8z'],
                ['label' => 'Réparateurs', 'icon' => 'M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z'],
            ] as $metier)
                <div class="bg-surface border border-border rounded-xl p-4 text-center shadow-sm">
                    <svg class="w-8 h-8 mx-auto mb-2 text-accent" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                        <path d="{{ $metier['icon'] }}" />
                    </svg>
                    <span class="text-sm font-medium">{{ $metier['label'] }}</span>
                </div>
            @endforeach
        </div>
    </section>

    <!-- ============ FONCTIONNALITÉS ============ -->
    <section id="fonctionnalites" class="max-w-7xl mx-auto px-6 py-12">
        <h2 class="text-2xl sm:text-3xl font-bold text-center mb-2">Tout ce qu'il faut pour piloter votre activité</h2>
        <p class="text-muted text-center mb-10">Clients, rendez-vous, paiements et rapports — au même endroit.</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach ([
                ['title' => 'Gestion des clients', 'text' => 'Toutes les informations de vos clients centralisées : contact, historique, sommes encaissées.', 'icon' => 'M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75'],
                ['title' => 'Rendez-vous', 'text' => 'Planifiez, confirmez et suivez vos rendez-vous sans conflit d\'horaire.', 'icon' => 'M3 4h18v18H3zM16 2v4M8 2v4M3 10h18'],
                ['title' => 'Paiements', 'text' => 'Enregistrez vos recettes (espèces, Mobile Money, carte) et gardez un historique fiable.', 'icon' => 'M1 4h22v16H1zM1 10h22'],
                ['title' => 'Rapports', 'text' => 'Suivez votre chiffre d\'affaires par période, service et méthode de paiement.', 'icon' => 'M18 20V10M12 20V4M6 20v-6'],
            ] as $feature)
                <div class="bg-surface border border-border rounded-xl p-5 shadow-sm">
                    <div class="w-11 h-11 rounded-lg bg-accent-light text-warning flex items-center justify-center mb-4">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="{{ $feature['icon'] }}" />
                        </svg>
                    </div>
                    <h3 class="font-semibold mb-2">{{ $feature['title'] }}</h3>
                    <p class="text-sm text-muted leading-relaxed">{{ $feature['text'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <!-- ============ CTA FINAL ============ -->
    <section class="bg-primary text-white text-center py-14">
        <div class="max-w-2xl mx-auto px-6">
            <h2 class="text-2xl font-bold mb-2">Prêt à gagner du temps sur la gestion de votre activité ?</h2>
            <p class="text-white/70 mb-6">Créez votre espace entreprise en quelques minutes, sans engagement.</p>
            <a href="{{ route('register') }}" class="inline-flex items-center justify-center h-11 px-6 bg-accent text-primary-dark rounded-xl font-semibold text-sm hover:bg-[#E08C00] transition">
                Commencer gratuitement
            </a>
        </div>
    </section>

    <!-- ============ FOOTER ============ -->
    <footer class="bg-primary-dark text-white/60 py-8">
        <div class="max-w-7xl mx-auto px-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-2 text-white font-bold">
                <img src="{{ asset('images/logo.png') }}" alt="Logo BizFlow" class="h-6 w-6">
                BizFlow
            </div>
            <nav class="flex gap-4 text-sm">
                <a href="#" class="hover:text-white">Fonctionnalités</a>
                <a href="#" class="hover:text-white">Tarifs</a>
                <a href="#" class="hover:text-white">Mentions légales</a>
                <a href="#" class="hover:text-white">Contact</a>
            </nav>
            <span class="text-sm">Simplifiez la gestion de votre activité.</span>
        </div>
    </footer>

</body>
</html>
