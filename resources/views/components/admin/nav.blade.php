@php
    $links = [
        ['route' => 'admin.dashboard', 'match' => 'admin.dashboard', 'label' => 'Genel Bakış', 'icon' => 'dashboard'],
        ['route' => 'admin.users', 'match' => 'admin.users*', 'label' => 'Kullanıcılar', 'icon' => 'users'],
        ['route' => 'admin.posts', 'match' => 'admin.posts*', 'label' => 'Gönderiler', 'icon' => 'posts'],
        ['route' => 'admin.stories', 'match' => 'admin.stories*', 'label' => 'Hikâyeler', 'icon' => 'stories'],
        ['route' => 'admin.messages', 'match' => 'admin.messages*', 'label' => 'Mesajlar', 'icon' => 'messages'],
        ['route' => 'admin.super-likes', 'match' => 'admin.super-likes*', 'label' => 'Süper Beğeniler', 'icon' => 'likes'],
        ['route' => 'admin.settings', 'match' => 'admin.settings', 'label' => 'Ayarlar', 'icon' => 'settings'],
    ];
@endphp

<nav class="space-y-1.5" aria-label="Yönetim menüsü">
    @foreach ($links as $link)
        @php $active = request()->routeIs($link['match']); @endphp
        <a
            href="{{ route($link['route']) }}"
            @class([
                'admin-nav-link flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition',
                'admin-nav-link--active bg-brand-600 text-white shadow-lg shadow-brand-950/30' => $active,
                'text-neutral-400 hover:bg-white/7 hover:text-white' => ! $active,
            ])
            @if ($active) aria-current="page" @endif
        >
            <span @class([
                'grid size-8 place-items-center rounded-lg transition',
                'bg-white/18 text-white' => $active,
                'bg-white/7 text-neutral-400' => ! $active,
            ])>
                @switch($link['icon'])
                    @case('users')
                        <svg viewBox="0 0 24 24" class="size-[1.05rem]" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm13 10v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        @break
                    @case('posts')
                        <svg viewBox="0 0 24 24" class="size-[1.05rem]" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4 19.5V5a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v14.5M8 7h8M8 11h8M8 15h5M2 21h20"/></svg>
                        @break
                    @case('stories')
                        <svg viewBox="0 0 24 24" class="size-[1.05rem]" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path stroke-linecap="round" d="M12 8v4l2.5 1.5"/></svg>
                        @break
                    @case('messages')
                        <svg viewBox="0 0 24 24" class="size-[1.05rem]" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v10Z"/></svg>
                        @break
                    @case('likes')
                        <svg viewBox="0 0 24 24" class="size-[1.05rem]" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21s-7-4.5-7-10a4.5 4.5 0 0 1 8-2.8A4.5 4.5 0 0 1 19 11c0 5.5-7 10-7 10Z"/></svg>
                        @break
                    @case('settings')
                        <svg viewBox="0 0 24 24" class="size-[1.05rem]" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.4 15a1.7 1.7 0 0 0 .34 1.88l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.7 1.7 0 0 0-1.88-.34 1.7 1.7 0 0 0-1.03 1.56V21a2 2 0 1 1-4 0v-.09A1.7 1.7 0 0 0 8.94 19.4a1.7 1.7 0 0 0-1.88.34l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06A1.7 1.7 0 0 0 4.57 15 1.7 1.7 0 0 0 3 14H3a2 2 0 1 1 0-4h.09A1.7 1.7 0 0 0 4.6 8.94a1.7 1.7 0 0 0-.34-1.88L4.2 7A2 2 0 1 1 7.03 4.2l.06.06A1.7 1.7 0 0 0 9 4.57h.01A1.7 1.7 0 0 0 10 3.09V3a2 2 0 1 1 4 0v.09a1.7 1.7 0 0 0 1.03 1.51 1.7 1.7 0 0 0 1.88-.34l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06A1.7 1.7 0 0 0 19.4 9v.01A1.7 1.7 0 0 0 20.91 10H21a2 2 0 1 1 0 4h-.09A1.7 1.7 0 0 0 19.4 15Z"/></svg>
                        @break
                    @default
                        <svg viewBox="0 0 24 24" class="size-[1.05rem]" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><rect x="3" y="3" width="7" height="7" rx="2"/><rect x="14" y="3" width="7" height="7" rx="2"/><rect x="3" y="14" width="7" height="7" rx="2"/><rect x="14" y="14" width="7" height="7" rx="2"/></svg>
                @endswitch
            </span>
            <span>{{ $link['label'] }}</span>
        </a>
    @endforeach
</nav>
