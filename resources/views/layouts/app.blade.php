<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">

        <title>{{ config('app.name', 'BizFlow') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-ink antialiased">
        <div class="min-h-screen grid grid-cols-1 sm:grid-cols-[76px_1fr] lg:grid-cols-[250px_1fr] bg-background">

            @include('layouts.sidebar')

            <div class="flex flex-col min-w-0">
                @include('layouts.topbar')
                <x-toast />

                @isset($header)
                    <header class="bg-surface border-b border-border">
                        <div class="py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <main class="pb-20 sm:pb-0">
                    {{ $slot }}
                </main>
            </div>

        </div>

        @include('layouts.mobile-nav')
    </body>
</html>
