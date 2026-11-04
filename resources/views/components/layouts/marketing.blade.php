@props([
    'title' => 'Gönül Köprüsü — Tanışmanın en doğal yolu',
    'description' => 'Şehirlerden ve samimi hikâyelerden başlayan güvenli ve gerçek tanışmalar keşfet.',
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#fffaf8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}">

    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="min-h-[dvh] bg-white text-ink antialiased">
    <div class="flex min-h-[dvh] flex-col overflow-x-hidden">
        <header class="sticky top-0 z-50 border-b border-white/70 bg-white/85 backdrop-blur-xl">
            <nav class="mx-auto flex min-h-18 max-w-7xl items-center justify-between gap-4 px-4 sm:px-6 lg:px-8" aria-label="Ana menü">
                <a href="{{ route('home') }}" class="shrink-0" aria-label="Gönül Köprüsü ana sayfa">
                    <x-brand-logo size="md" />
                </a>

                <div class="hidden items-center gap-8 md:flex">
                    <a href="#nasil-calisir" class="text-sm font-medium text-ink-muted transition hover:text-ink">Nasıl çalışır?</a>
                    <a href="#ozellikler" class="text-sm font-medium text-ink-muted transition hover:text-ink">Özellikler</a>
                    <a href="#guvenlik" class="text-sm font-medium text-ink-muted transition hover:text-ink">Güvenlik</a>
                </div>

                <div class="flex shrink-0 items-center gap-2">
                    @auth
                        <a href="{{ route('feed.index') }}" class="inline-flex min-h-11 items-center justify-center rounded-full bg-brand-600 px-5 text-sm font-semibold text-white shadow-lg shadow-brand-200 transition hover:-translate-y-0.5 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2">
                            Akışı keşfet
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="hidden min-h-11 items-center justify-center rounded-full px-4 text-sm font-semibold text-ink transition hover:bg-brand-50 sm:inline-flex">Giriş yap</a>
                        <a href="{{ route('register') }}" class="inline-flex min-h-11 items-center justify-center rounded-full bg-brand-600 px-5 text-sm font-semibold text-white shadow-lg shadow-brand-200 transition hover:-translate-y-0.5 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2">
                            Ücretsiz başla
                        </a>
                    @endauth
                </div>
            </nav>
        </header>

        <main class="flex-1">
            {{ $slot }}
        </main>

        <footer class="border-t border-line/70 bg-neutral-50/70">
            <div class="mx-auto flex max-w-7xl flex-col gap-8 px-4 py-10 sm:px-6 md:flex-row md:items-end md:justify-between lg:px-8">
                <div>
                    <x-brand-logo size="md" />
                    <p class="mt-3 max-w-sm text-sm leading-6 text-ink-muted">Samimi, güvenli ve karşılıklı saygıya dayalı tanışmalar için yeni bir alan.</p>
                </div>

                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:gap-8">
                    <div class="flex flex-wrap gap-x-5 gap-y-2 text-sm text-ink-muted">
                        <a href="#ozellikler" class="transition hover:text-ink">Özellikler</a>
                        <a href="#guvenlik" class="transition hover:text-ink">Güvenlik</a>
                        <a href="{{ route('home') }}#nasil-calisir" class="transition hover:text-ink">Nasıl çalışır?</a>
                    </div>
                    <p class="text-xs text-ink-subtle">© {{ now()->year }} Gönül Köprüsü</p>
                </div>
            </div>
        </footer>
    </div>

    @stack('scripts')
</body>
</html>
