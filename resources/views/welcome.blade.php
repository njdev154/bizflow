<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="BizFlow aide les entreprises de services à gérer leurs clients, rendez-vous, paiements et activité commerciale en un seul tableau de bord.">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <meta name="theme-color" content="#0B1F3A">
    <title>BizFlow — Gestion simple pour les entreprises de services</title>

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
                <a href="#au-quotidien" class="transition hover:text-slate-900">Au quotidien</a>
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
            <div class="mx-auto grid max-w-7xl items-center gap-12 px-6 py-20 lg:grid-cols-[1.1fr_0.9fr]">
                <div>
                    <span class="brand-pill mb-6">Pour les entreprises de services</span>
                    <h1 class="max-w-xl text-4xl font-extrabold leading-tight sm:text-5xl">
                        Vos rendez-vous, vos clients et vos encaissements au même endroit.
                    </h1>
                    <p class="mt-5 max-w-lg text-lg text-slate-200">
                        Pour un salon, un institut ou une petite équipe, BizFlow réunit les fiches clients, les prestations, le planning et les paiements. Le tableau de bord montre les rendez-vous et les recettes enregistrées.
                    </p>

                    <div class="mt-8 flex flex-wrap items-center gap-3">
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-lg bg-[#f59e0b] px-6 py-3 text-sm font-semibold text-slate-900 transition hover:bg-[#f5b94b]">
                            Créer mon espace
                        </a>
                        <a href="#fonctionnalites" class="inline-flex items-center justify-center border-b border-white/40 px-1 py-3 text-sm font-semibold text-white transition hover:border-white">
                            Voir ce que l’on peut gérer
                        </a>
                    </div>

                </div>

                <div class="relative border-l border-white/20 py-3 pl-6 sm:pl-9">
                    <p class="text-xs font-semibold uppercase tracking-[0.16em] text-amber-300">Un cas concret</p>
                    <h2 class="mt-3 text-2xl font-bold text-white">Un rendez-vous ne doit pas en chevaucher un autre.</h2>
                    <p class="mt-4 max-w-md leading-7 text-slate-300">
                        À la réservation, BizFlow vérifie la durée de la prestation et les rendez-vous déjà prévus pour la même personne. Si le créneau se chevauche, il vous demande d’en choisir un autre.
                    </p>
                    <a href="#fonctionnalites" class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-amber-300 hover:text-amber-200">
                        Voir les autres outils
                        <span aria-hidden="true">→</span>
                    </a>
                </div>
            </div>
        </section>

        <section id="fonctionnalites" class="border-y border-slate-200 bg-white py-16">
            <div class="mx-auto grid max-w-7xl gap-10 px-6 md:grid-cols-[0.8fr_1.2fr]">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.16em] text-amber-700">Dans BizFlow</p>
                    <h2 class="mt-3 text-3xl font-bold text-slate-900">Ce que vous pouvez suivre</h2>
                    <p class="mt-4 max-w-sm leading-7 text-slate-600">
                        Chaque partie répond à une tâche courante : retrouver un client, préparer une prestation ou vérifier les encaissements.
                    </p>
                </div>

                <div class="divide-y divide-slate-200">
                    @foreach([
                        ['number' => '01', 'title' => 'Clients', 'text' => 'Retrouvez les coordonnées, les notes et les informations de contact.'],
                        ['number' => '02', 'title' => 'Services', 'text' => 'Définissez vos prestations, leur durée et leur prix.'],
                        ['number' => '03', 'title' => 'Rendez-vous', 'text' => 'Associez un client, une prestation, un horaire et, si besoin, un membre de l’équipe.'],
                        ['number' => '04', 'title' => 'Paiements et rapports', 'text' => 'Enregistrez les règlements et consultez les recettes par période.'],
                    ] as $feature)
                        <article class="grid gap-2 py-5 sm:grid-cols-[3rem_10rem_1fr] sm:gap-4">
                            <span class="font-mono text-sm text-amber-700">{{ $feature['number'] }}</span>
                            <h3 class="font-semibold text-slate-900">{{ $feature['title'] }}</h3>
                            <p class="text-sm leading-6 text-slate-600">{{ $feature['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="au-quotidien" class="mx-auto grid max-w-7xl gap-8 px-6 py-16 md:grid-cols-[1fr_1.2fr]">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.16em] text-amber-700">Au quotidien</p>
                <h2 class="mt-3 text-3xl font-bold text-slate-900">D’abord le travail du jour. Ensuite le bilan.</h2>
            </div>
            <div class="border-l border-slate-300 pl-6 sm:pl-8">
                <p class="leading-7 text-slate-700">
                    L’accueil montre les rendez-vous prévus aujourd’hui, les derniers paiements et les recettes des sept derniers jours. Les montants affichés viennent des paiements enregistrés dans votre espace.
                </p>
                <a href="{{ route('register') }}" class="mt-6 inline-flex items-center gap-2 font-semibold text-slate-900 underline decoration-amber-500 decoration-2 underline-offset-4 hover:text-amber-800">
                    Créer mon espace
                    <span aria-hidden="true">→</span>
                </a>
            </div>
        </section>

        <section id="contact" class="border-y border-slate-200 bg-white">
            <div class="mx-auto grid max-w-7xl gap-8 px-6 py-14 md:grid-cols-[1fr_1.2fr]">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.16em] text-amber-700">Contact</p>
                    <h2 class="mt-3 text-3xl font-bold text-slate-900">Une question sur BizFlow ?</h2>
                    <p class="mt-4 max-w-sm leading-7 text-slate-600">Écris-nous par e-mail ou envoie un message WhatsApp.</p>
                </div>

                <div class="divide-y divide-slate-200 border-y border-slate-200">
                    <a href="mailto:auraachitecture@gmail.com" class="group flex items-center justify-between gap-4 py-5">
                        <span>
                            <span class="block text-sm text-slate-500">E-mail</span>
                            <span class="mt-1 block font-semibold text-slate-900 group-hover:text-amber-800">auraachitecture@gmail.com</span>
                        </span>
                        <span class="text-sm font-medium text-slate-600 group-hover:text-amber-800">Écrire <span aria-hidden="true">→</span></span>
                    </a>
                    <a href="https://wa.me/2250100292573?text=Bonjour%2C%20je%20souhaite%20en%20savoir%20plus%20sur%20BizFlow." target="_blank" rel="noopener noreferrer" class="group flex items-center justify-between gap-4 py-5">
                        <span>
                            <span class="block text-sm text-slate-500">WhatsApp</span>
                            <span class="mt-1 block font-semibold text-slate-900 group-hover:text-amber-800">01 00 29 25 73</span>
                        </span>
                        <span class="text-sm font-medium text-slate-600 group-hover:text-amber-800">Envoyer un message <span aria-hidden="true">→</span></span>
                    </a>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-[#f3f5f8]">
        <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-4 px-6 py-8 text-center sm:flex-row sm:text-left">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo BizFlow" class="h-8 w-8 rounded-lg">
                <span class="text-lg font-extrabold text-slate-900">BizFlow</span>
            </div>
            <p class="text-sm text-slate-600">Clients, prestations, rendez-vous et paiements.</p>
            <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-lg bg-[#0f172a] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800">Créer un compte</a>
        </div>
    </footer>
</body>
</html>
