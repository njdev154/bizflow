<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'BizFlow') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-ink antialiased">
        <div class="min-h-screen grid grid-cols-1 md:grid-cols-[minmax(360px,480px)_1fr]">

            <!-- Colonne formulaire -->
            <div class="flex flex-col justify-center px-6 py-10 md:px-16 bg-surface">
                <div class="w-full max-w-sm mx-auto">
                    <a href="/" class="flex items-center gap-2 mb-8 font-bold text-lg text-ink">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo BizFlow" class="h-8 w-8">
                        BizFlow
                    </a>

                    {{ $slot }}
                </div>
            </div>

            <!-- Colonne de marque -->
            <div class="hidden md:flex relative overflow-hidden items-center justify-center bg-primary text-white p-16">
                <div class="absolute w-[640px] h-[640px] rounded-full -right-56 -bottom-64"
                     style="background: radial-gradient(circle at 30% 30%, rgba(245,158,11,0.35), rgba(245,158,11,0) 65%);"></div>
                <div class="absolute w-[360px] h-[360px] rounded-full -left-36 -top-36 border border-white/10"></div>

                <div class="relative z-10 max-w-md">
                    @isset($aside)
                        {{ $aside }}
                    @else
                        <h2 class="text-2xl font-bold mb-4">Plus qu'un outil, un partenaire pour votre croissance.</h2>
                        <p class="text-white/70">BizFlow accompagne déjà plus de 2000 entreprises de services dans la gestion simple de leur activité au quotidien.</p>
                    @endisset
                </div>
            </div>

        </div>
    </body>
</html>
