<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="BizFlow aide les entreprises de services à gérer leurs clients, rendez-vous, paiements et activité commerciale en un seul tableau de bord.">
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <title>{{ config('app.name', 'BizFlow') }} — Gestion simple pour les entreprises de services</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-slate-900 bg-[#f3f5f8]">
    <header class="sticky top-0 z-20 border-b border-slate-200/80 bg-white/80 backdrop-blur-md">
        <div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-6">
            <a href="/" class="flex items-center gap-3 font-extrabold text-lg text-slate-900">
                <img src="{{ asset('images/logo.png') }}" alt="Logo BizFlow" class="h-9 w-9 rounded-lg">
                BizFlow
            </a>

            <nav class="hidden items-center gap-8 text-sm font-medium text-slate-600 md:flex">
                <a href="#accueil" class="transition hover:text-slate-900">Accueil</a>
                <a href="#fonctionnalites" class="transition hover:text-slate-900">Fonctionnalités</a>
                <a href="#avantages" class="transition hover:text-slate-900">Avantages</a>
                <a href="#contact" class="transition hover:text-slate-900">Contact</a>
            </nav>

            <div class="flex items-center gap-3">
                <a href="{{ route('login') }}" class="hidden rounded-xl px-4 py-2 text-sm font-semibold text-slate-600 transition hover:text-slate-900 sm:inline-flex">Se connecter</a>
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-xl bg-[#0f172a] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">Créer un compte</a>
            </div>
        </div>
    </header>

    <main id="accueil" class="overflow-hidden">
        <section class="hero-glow relative border-b border-slate-200 bg-[#0b1f3a] text-white">
            <div class="mx-auto grid max-w-7xl items-center gap-10 px-6 py-20 lg:grid-cols-[1.1fr_0.9fr]">
                <div>
                    <span class="brand-pill mb-6">Gestion • Rendez-vous • Paiements</span>
                    <h1 class="max-w-xl text-4xl font-extrabold leading-tight sm:text-5xl">
                        Une gestion plus claire pour votre activité de services.
                    </h1>
                    <p class="mt-5 max-w-lg text-lg text-slate-200">
                        BizFlow aide les salons, instituts, cabinets et PME à centraliser clients, planning, facturation et performance dans un seul espace simple et fiable.
                    </p>

                    <div class="mt-8 flex flex-wrap items-center gap-3">
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-xl bg-[#f59e0b] px-6 py-3 text-sm font-semibold text-slate-900 shadow-lg shadow-amber-500/20 transition hover:bg-[#f5b94b]">
                            Commencer gratuitement
                        </a>
                        <a href="#fonctionnalites" class="inline-flex items-center justify-center rounded-xl border border-white/20 bg-white/5 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white/10">
                            Découvrir les fonctionnalités
                        </a>
                    </div>

                    <div class="mt-10 flex flex-wrap items-center gap-6 text-sm text-slate-200">
                        <div>
                            <span class="block text-3xl font-extrabold text-white">+2k</span>
                            <span>entreprises engagées</span>
                        </div>
                        <div>
                            <span class="block text-3xl font-extrabold text-white">15 min</span>
                            <span>pour prendre le contrôle</span>
                        </div>
                        <div>
                            <span class="block text-3xl font-extrabold text-white">24/7</span>
                            <span>suivi de l’activité</span>
                        </div>
                    </div>
                </div>

                <div class="preview-card relative overflow-hidden rounded-[28px] p-4">
                    <img src="{{ asset('images/bizflow-dashboard-preview.svg') }}" alt="Aperçu du tableau de bord BizFlow" class="w-full rounded-[20px] object-cover">
                </div>
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-6 py-16" id="avantages">
            <div class="mb-8 text-center">
                <p class="text-sm font-semibold uppercase tracking-[0.18em] text-amber-600">Pourquoi BizFlow</p>
                <h2 class="mt-3 text-3xl font-bold text-slate-900">Des outils conçus pour la réalité de terrain</h2>
            </div>

            <div class="grid gap-5 md:grid-cols-3">
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-amber-100 text-xl text-amber-700">⚡</div>
                    <h3 class="mb-2 text-xl font-bold text-slate-900">Gain de temps immédiat</h3>
                    <p class="text-sm leading-6 text-slate-600">Trouvez les bons rendez-vous, suivez les paiements et évitez le travail manuel inutile.</p>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-sky-100 text-xl text-sky-700">📊</div>
                    <h3 class="mb-2 text-xl font-bold text-slate-900">Vue d’ensemble fiable</h3>
                    <p class="text-sm leading-6 text-slate-600">Le tableau de bord centralise le chiffre d’affaires, les clients actifs et le suivi quotidien.</p>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-100 text-xl text-emerald-700">✅</div>
                    <h3 class="mb-2 text-xl font-bold text-slate-900">Moins d’erreurs</h3>
                    <p class="text-sm leading-6 text-slate-600">Les conflits de créneau, les rapports et les données de paiement sont mieux sécurisés et plus lisibles.</p>
                </div>
            </div>
        </section>

        <section id="fonctionnalites" class="bg-white py-16">
            <div class="mx-auto max-w-7xl px-6">
                <div class="mb-10 text-center">
                    <p class="text-sm font-semibold uppercase tracking-[0.18em] text-amber-600">Fonctionnalités</p>
                    <h2 class="mt-3 text-3xl font-bold text-slate-900">Tout ce qu’il faut pour gérer une activité de services</h2>
                </div>

                <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-4">
                    @foreach([
                        ['title' => 'Clients', 'text' => 'Centralisez les profils, les contacts, les notes et l’historique de chaque client.', 'icon' => '👥'],
                        ['title' => 'Rendez-vous', 'text' => 'Planifiez les créneaux, vérifiez les conflits et suivez le statut de chaque prise en charge.', 'icon' => '📅'],
                        ['title' => 'Paiements', 'text' => 'Enregistrez les transactions et suivez les revenus par jour, statut et méthode.', 'icon' => '💳'],
                        ['title' => 'Rapports', 'text' => 'Consultez rapidement votre activité, la performance et les tendances de chiffre d’affaires.', 'icon' => '📈'],
                    ] as $feature)
                        <article class="feature-card rounded-2xl border border-slate-200 bg-slate-50 p-6">
                            <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-white text-2xl shadow-sm">{{ $feature['icon'] }}</div>
                            <h3 class="mb-2 text-xl font-bold text-slate-900">{{ $feature['title'] }}</h3>
                            <p class="text-sm leading-6 text-slate-600">{{ $feature['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-6 py-16">
            <div class="mb-10 text-center">
                <p class="text-sm font-semibold uppercase tracking-[0.18em] text-amber-600">Méthode</p>
                <h2 class="mt-3 text-3xl font-bold text-slate-900">Un workflow simple, de l’inscription au suivi</h2>
            </div>

            <div class="grid gap-6 md:grid-cols-3">
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="step-dot mb-4">1</div>
                    <h3 class="mb-2 text-xl font-bold text-slate-900">Créez votre espace</h3>
                    <p class="text-sm leading-6 text-slate-600">Configurez votre entreprise, vos services et votre équipe en quelques minutes.</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="step-dot mb-4">2</div>
                    <h3 class="mb-2 text-xl font-bold text-slate-900">Gérez votre activité</h3>
                    <p class="text-sm leading-6 text-slate-600">Suivez les rendez-vous, les clients et les paiements sans friction.</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="step-dot mb-4">3</div>
                    <h3 class="mb-2 text-xl font-bold text-slate-900">Prenez des décisions</h3>
                    <p class="text-sm leading-6 text-slate-600">Analysez les performances et planifiez votre croissance avec des données fiables.</p>
                </div>
            </div>
        </section>

        <section class="bg-[#0b1f3a] py-16 text-white">
            <div class="mx-auto max-w-4xl px-6 text-center">
                <p class="text-sm font-semibold uppercase tracking-[0.18em] text-amber-300">À retenir</p>
                <h2 class="mt-3 text-3xl font-bold">BizFlow ne remplace pas votre métier : il le rend plus fluide.</h2>
                <p class="mx-auto mt-5 max-w-2xl text-lg text-slate-200">
                    Le produit est pensé pour les entreprises de services qui veulent gagner du temps, réduire les erreurs et mieux maîtriser leur activité au quotidien.
                </p>
            </div>
        </section>
    </main>

    <footer id="contact" class="border-t border-slate-200 bg-white">
        <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-4 px-6 py-8 text-center sm:flex-row sm:text-left">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo BizFlow" class="h-8 w-8 rounded-lg">
                <span class="text-lg font-extrabold text-slate-900">BizFlow</span>
            </div>
            <p class="text-sm text-slate-600">Gérez votre PME de services avec plus de clarté.</p>
            <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-xl bg-[#0f172a] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800">Créer un compte</a>
        </div>
    </footer>
</body>
</html>
