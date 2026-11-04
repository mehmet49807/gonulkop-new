@props([
    'title' => 'Yönetim Paneli',
    'description' => 'Gönülkop yönetim paneli',
])

@php
    $adminName = session('admin_name', 'Yönetici');
    $adminEmail = session('admin_email', 'admin@gonulkop.com');
    $initials = collect(preg_split('/\s+/', trim($adminName)))
        ->filter()->take(2)->map(fn (string $part) => mb_strtoupper(mb_substr($part, 0, 1)))->implode('');
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#111936">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} · Gönülkop Yönetim</title>
    <meta name="description" content="{{ $description }}">
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="admin-theme min-h-[dvh] bg-[#f4f7fc] text-ink antialiased">
    <div class="min-h-[dvh] lg:grid lg:grid-cols-[17.5rem_minmax(0,1fr)]">
        <aside class="fixed inset-y-0 left-0 z-50 hidden w-[17.5rem] flex-col overflow-y-auto bg-neutral-950 px-4 py-5 text-white lg:flex">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 rounded-2xl px-2 py-1.5">
                <span class="grid size-11 place-items-center rounded-2xl bg-brand-600 shadow-lg shadow-brand-950/40">
                    <svg viewBox="0 0 24 24" class="size-6 fill-current" aria-hidden="true"><path d="M4 20c0-3.31 2.69-6 6-6s6 2.69 6 6M10 20c0-3.31 2.69-6 6-6s6 2.69 6 6M4 14V20M10 14V20M16 14V20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M12 17.2a2.2 2.2 0 0 1 2.2-2.2l-2.2 2.2-2.2-2.2a2.2 2.2 0 0 1 2.2-2.2Z"/></svg>
                </span>
                <span>
                    <span class="block text-sm font-black tracking-tight">Gönülkop</span>
                    <span class="block text-[0.65rem] font-semibold uppercase tracking-[0.18em] text-neutral-500">Yönetim Merkezi</span>
                </span>
            </a>

            <div class="mt-9 px-2 text-[0.65rem] font-bold uppercase tracking-[0.2em] text-neutral-600">Çalışma alanı</div>
            <div class="mt-3"><x-admin.nav /></div>

            <div class="mt-auto pt-8">
                <div class="rounded-2xl border border-white/8 bg-white/[0.04] p-3.5">
                    <div class="flex items-center gap-3">
                        <span class="grid size-10 shrink-0 place-items-center rounded-xl bg-brand-500 text-xs font-black">{{ $initials ?: 'YK' }}</span>
                        <span class="min-w-0">
                            <span class="block truncate text-sm font-bold">{{ $adminName }}</span>
                            <span class="block truncate text-xs text-neutral-500">{{ $adminEmail }}</span>
                        </span>
                    </div>
                    <form method="POST" action="{{ route('admin.logout') }}" class="mt-3 border-t border-white/8 pt-3">
                        @csrf
                        <button type="submit" class="flex w-full items-center gap-2 rounded-xl px-2 py-2 text-xs font-semibold text-neutral-400 transition hover:bg-white/7 hover:text-white">
                            <svg viewBox="0 0 24 24" class="size-4" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/></svg>
                            Oturumu kapat
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <div class="min-w-0 lg:col-start-2">
            <header class="sticky top-0 z-40 border-b border-neutral-200/80 bg-white/88 backdrop-blur-xl">
                <div class="flex min-h-20 items-center justify-between gap-4 px-4 sm:px-7 lg:px-9">
                    <div class="flex min-w-0 items-center gap-3">
                        <button type="button" data-admin-menu-open class="grid size-10 shrink-0 place-items-center rounded-xl border border-neutral-200 bg-white text-neutral-700 lg:hidden" aria-label="Menüyü aç" aria-controls="admin-mobile-menu" aria-expanded="false">
                            <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16"/></svg>
                        </button>
                        <div class="min-w-0">
                            <p class="text-[0.65rem] font-bold uppercase tracking-[0.18em] text-brand-600">Yönetim Paneli</p>
                            <h1 class="truncate text-lg font-black tracking-tight text-neutral-950 sm:text-xl">{{ $title }}</h1>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 sm:gap-3">
                        <a href="{{ route('home') }}" class="hidden items-center gap-2 rounded-xl border border-neutral-200 bg-white px-3.5 py-2.5 text-xs font-bold text-neutral-700 transition hover:border-brand-200 hover:text-brand-700 sm:inline-flex">
                            Siteyi görüntüle
                            <svg viewBox="0 0 24 24" class="size-4" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M14 3h7v7M10 14 21 3M21 14v5a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5"/></svg>
                        </a>
                        <span class="grid size-10 place-items-center rounded-xl bg-neutral-950 text-xs font-black text-white lg:hidden">{{ $initials ?: 'YK' }}</span>
                    </div>
                </div>
            </header>


            <main class="px-4 py-6 sm:px-7 sm:py-8 lg:px-9 lg:py-9">
                @if (session('success'))
                    <div class="mb-6 flex items-center gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-800" role="status">
                        <span class="grid size-6 shrink-0 place-items-center rounded-full bg-emerald-500 text-white">✓</span>{{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="mb-6 flex items-center gap-3 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-800" role="alert">
                        <span class="grid size-6 shrink-0 place-items-center rounded-full bg-red-500 text-white">!</span>{{ session('error') }}
                    </div>
                @endif
                {{ $slot }}
            </main>
        </div>
    </div>

    <div id="admin-mobile-menu" class="fixed inset-0 z-[60] hidden lg:hidden" aria-hidden="true">
        <button type="button" data-admin-menu-close class="absolute inset-0 bg-neutral-950/45 backdrop-blur-sm" aria-label="Menüyü kapat"></button>
        <aside class="absolute inset-y-0 left-0 flex w-[min(19rem,88vw)] flex-col bg-neutral-950 p-5 text-white shadow-2xl">
            <div class="flex items-center justify-between">
                <span class="text-sm font-black">Gönülkop Yönetim</span>
                <button type="button" data-admin-menu-close class="grid size-9 place-items-center rounded-xl bg-white/8" aria-label="Menüyü kapat">
                    <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" d="m6 6 12 12M18 6 6 18"/></svg>
                </button>
            </div>
            <div class="mt-8"><x-admin.nav /></div>
            <form method="POST" action="{{ route('admin.logout') }}" class="mt-auto border-t border-white/10 pt-4">
                @csrf
                <button type="submit" class="flex w-full items-center gap-2 rounded-xl px-3 py-3 text-sm font-semibold text-neutral-400 hover:bg-white/7 hover:text-white">Oturumu kapat</button>
            </form>
        </aside>
    </div>

    @stack('scripts')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
