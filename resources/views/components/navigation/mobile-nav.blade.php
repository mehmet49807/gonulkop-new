@props([
    'items' => null,
])

@php
    $items ??= [
        [
            'label' => 'Akış',
            'route' => 'feed.index',
            'icon' => 'home',
        ],
        [
            'label' => 'Keşfet',
            'route' => Route::has('discover.index') ? 'discover.index' : 'discover',
            'icon' => 'discover',
        ],
        [
            'label' => 'Mesajlar',
            'route' => 'messages.index',
            'icon' => 'chat',
        ],
        [
            'label' => 'Profil',
            'route' => Route::has('profile.index') ? 'profile.index' : 'profile.edit',
            'icon' => 'profile',
        ],
        [
            'label' => 'Ayarlar',
            'route' => Route::has('settings.edit') ? 'settings.edit' : '#',
            'icon' => 'settings',
        ],
    ];
    $columnClass = count($items) === 3 ? 'grid-cols-3' : 'grid-cols-5';
@endphp

<nav
    aria-label="Ana gezinme"
    {{ $attributes->merge(['class' => 'safe-bottom fixed inset-x-0 bottom-0 z-50 border-t border-line/80 bg-white/95 px-2 pt-1.5 shadow-[0_-8px_30px_oklch(0.22_0.02_280/0.08)] backdrop-blur-xl lg:hidden']) }}
>
    <div class="mx-auto grid max-w-xl {{ $columnClass }}">
        @foreach ($items as $item)
            @php
                $isActive = request()->routeIs($item['route']);
                $href = Route::has($item['route']) ? route($item['route']) : '#';
            @endphp

            <a
                href="{{ $href }}"
                @if (! Route::has($item['route'])) aria-disabled="true" @endif
                @if ($isActive) aria-current="page" @endif
                class="group flex min-h-14 flex-col items-center justify-center gap-0.5 rounded-2xl text-[0.6875rem] font-medium transition {{ $isActive ? 'text-brand-700' : 'text-muted hover:text-ink' }}"
            >
                <span class="grid size-8 place-items-center rounded-xl transition {{ $isActive ? 'bg-brand-50' : 'group-hover:bg-canvas' }}">
                    @switch($item['icon'])
                        @case('home')
                            <svg viewBox="0 0 24 24" class="size-[1.375rem] {{ $isActive ? 'fill-brand-100' : 'fill-none' }}" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955a1.126 1.126 0 0 1 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75" />
                            </svg>
                            @break

                        @case('discover')
                            <svg viewBox="0 0 24 24" class="size-[1.375rem] {{ $isActive ? 'fill-brand-100' : 'fill-none' }}" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <circle cx="12" cy="12" r="8.25" />
                                <path stroke-linecap="round" d="m15.25 8.75-2.1 4.4-4.4 2.1 2.1-4.4 4.4-2.1Z" />
                            </svg>
                            @break

                        @case('chat')
                            <svg viewBox="0 0 24 24" class="size-[1.375rem] {{ $isActive ? 'fill-brand-100' : 'fill-none' }}" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                            </svg>
                            @break

                        @case('profile')
                            <svg viewBox="0 0 24 24" class="size-[1.375rem] {{ $isActive ? 'fill-brand-100' : 'fill-none' }}" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                            @break

                        @case('settings')
                            <svg viewBox="0 0 24 24" class="size-[1.375rem] {{ $isActive ? 'fill-brand-100' : 'fill-none' }}" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065" />
                            </svg>
                            @break
                    @endswitch
                </span>
                <span>{{ $item['label'] }}</span>
            </a>
        @endforeach
    </div>
</nav>
