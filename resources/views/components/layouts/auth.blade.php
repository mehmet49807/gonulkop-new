@props([
    'title' => 'Gönül Köprüsü',
    'description' => null,
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#ffffff">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>

    @if ($description)
        <meta name="description" content="{{ $description }}">
    @endif

    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="min-h-[dvh] bg-canvas flex items-center justify-center">
    <main class="w-full max-w-md px-4 sm:px-6 py-12 sm:py-16">
        <section class="w-full animate-fade-up">
            {{ $slot }}
        </section>
    </main>

    @stack('scripts')
</body>
</html>
