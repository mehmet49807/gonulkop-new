<x-admin.layout title="Genel Bakış" description="Gönülkop platformunun güncel kullanıcı ve içerik özeti.">
    @php
        $userTotal = max($stats['total_users'], 1);
        $malePercent = round(($stats['male_users'] / $userTotal) * 100);
        $femalePercent = max(0, 100 - $malePercent);
    @endphp

    <section class="relative overflow-hidden rounded-[1.75rem] bg-neutral-950 px-6 py-7 text-white shadow-xl shadow-neutral-900/10 sm:px-8 sm:py-8">
        <div class="absolute -right-16 -top-24 size-64 rounded-full bg-brand-600/25 blur-3xl"></div>
        <div class="relative flex flex-col justify-between gap-7 sm:flex-row sm:items-end">
            <div>
                <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/6 px-3 py-1.5 text-[0.65rem] font-bold uppercase tracking-[0.16em] text-neutral-300"><span class="size-1.5 rounded-full bg-emerald-400"></span>Sistem aktif</span>
                <h2 class="mt-4 text-2xl font-black tracking-tight sm:text-3xl">Platformun nabzı burada.</h2>
                <p class="mt-2 max-w-xl text-sm leading-6 text-neutral-400">Üyelik, etkileşim ve içerik durumunu tek ekrandan takip edin.</p>
            </div>
            <div class="grid grid-cols-2 gap-3 sm:min-w-80">
                <div class="rounded-2xl border border-white/8 bg-white/5 p-4"><p class="text-[0.65rem] font-bold uppercase tracking-[0.14em] text-neutral-500">Bugün yeni üye</p><p class="mt-2 text-2xl font-black">{{ number_format($stats['new_users_today']) }}</p></div>
                <div class="rounded-2xl border border-white/8 bg-white/5 p-4"><p class="text-[0.65rem] font-bold uppercase tracking-[0.14em] text-neutral-500">Bugün mesaj</p><p class="mt-2 text-2xl font-black">{{ number_format($stats['messages_today']) }}</p></div>
            </div>
        </div>
    </section>

    <div class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @php
            $cards = [
                ['label' => 'Toplam üye', 'value' => $stats['total_users'], 'detail' => $stats['new_users_today'].' yeni bugün', 'icon' => 'users', 'tone' => 'brand'],
                ['label' => 'Premium üye', 'value' => $stats['premium_users'], 'detail' => $stats['total_users'] ? '%'.round(($stats['premium_users'] / $stats['total_users']) * 100).' oran' : 'Henüz üye yok', 'icon' => 'crown', 'tone' => 'amber'],
                ['label' => 'Gönderi', 'value' => $stats['total_posts'], 'detail' => $stats['published_posts'].' yayında', 'icon' => 'posts', 'tone' => 'blue'],
                ['label' => 'Mesaj', 'value' => $stats['total_messages'], 'detail' => $stats['total_stories'].' hikâye', 'icon' => 'messages', 'tone' => 'violet'],
            ];
            $tones = ['brand' => 'bg-brand-50 text-brand-700', 'amber' => 'bg-amber-50 text-amber-700', 'blue' => 'bg-sky-50 text-sky-700', 'violet' => 'bg-violet-50 text-violet-700'];
        @endphp
        @foreach ($cards as $card)
            <article class="group rounded-2xl border border-neutral-200/80 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                <div class="flex items-start justify-between gap-3">
                    <span class="grid size-10 place-items-center rounded-xl {{ $tones[$card['tone']] }}">
                        @if ($card['icon'] === 'users')
                            <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm13 10v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        @elseif ($card['icon'] === 'crown')
                            <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m3 7 4 4 5-7 5 7 4-4-2 11H5L3 7Z"/></svg>
                        @elseif ($card['icon'] === 'posts')
                            <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4 19.5V5a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v14.5M8 7h8M8 11h8M8 15h5"/></svg>
                        @else
                            <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v10Z"/></svg>
                        @endif
                    </span>
                    <span class="text-[0.65rem] font-bold uppercase tracking-[0.12em] text-neutral-400">{{ $card['label'] }}</span>
                </div>
                <p class="mt-5 text-3xl font-black tracking-tight text-neutral-950">{{ number_format($card['value']) }}</p>
                <p class="mt-1 text-xs text-neutral-500">{{ $card['detail'] }}</p>
            </article>
        @endforeach
    </div>

    <div class="mt-6 grid gap-6 xl:grid-cols-[1.35fr_.65fr]">
        <section class="rounded-2xl border border-neutral-200/80 bg-white p-5 shadow-sm sm:p-6" aria-labelledby="recent-users-title">
            <div class="flex items-center justify-between gap-4">
                <div><h2 id="recent-users-title" class="text-base font-black text-neutral-950">Yeni üyeler</h2><p class="mt-1 text-xs text-neutral-500">Platforma en son katılan hesaplar</p></div>
                <a href="{{ route('admin.users') }}" class="text-xs font-bold text-brand-700 hover:text-brand-800">Tümünü gör →</a>
            </div>
            <div class="mt-5 divide-y divide-neutral-100">
                @forelse ($stats['recent_users'] as $user)
                    <a href="{{ route('admin.users.show', $user) }}" class="flex items-center gap-3 py-3.5 first:pt-0 last:pb-0">
                        <x-ui.avatar :src="$user->avatar_url" :name="$user->name" size="sm" />
                        <span class="min-w-0 flex-1"><span class="block truncate text-sm font-bold text-neutral-900">{{ $user->name }}</span><span class="block truncate text-xs text-neutral-500">@{{ $user->username ?: 'kullanici' }} · {{ $user->city ?: 'Şehir belirtilmemiş' }}</span></span>
                        <span class="hidden rounded-full bg-neutral-100 px-2.5 py-1 text-[0.65rem] font-bold text-neutral-600 sm:inline">{{ $user->created_at?->diffForHumans() ?? '—' }}</span>
                    </a>
                @empty
                    <p class="py-8 text-center text-sm text-neutral-500">Henüz üye kaydı bulunmuyor.</p>
                @endforelse
            </div>
        </section>

        <section class="rounded-2xl border border-neutral-200/80 bg-white p-5 shadow-sm sm:p-6" aria-labelledby="distribution-title">
            <h2 id="distribution-title" class="text-base font-black text-neutral-950">Üye dağılımı</h2>
            <p class="mt-1 text-xs text-neutral-500">Cinsiyete göre kayıt oranı</p>
            <div class="mt-7 flex h-3 overflow-hidden rounded-full bg-neutral-100" aria-label="Kadın yüzde {{ $femalePercent }}, erkek yüzde {{ $malePercent }}"><span class="bg-brand-500" style="width: {{ $femalePercent }}%"></span><span class="bg-sky-500" style="width: {{ $malePercent }}%"></span></div>
            <div class="mt-6 space-y-4">
                <div class="flex items-center justify-between text-sm"><span class="flex items-center gap-2 font-semibold text-neutral-700"><i class="size-2.5 rounded-full bg-brand-500"></i>Kadın</span><strong>{{ number_format($stats['female_users']) }} <small class="font-medium text-neutral-400">(%{{ $femalePercent }})</small></strong></div>
                <div class="flex items-center justify-between text-sm"><span class="flex items-center gap-2 font-semibold text-neutral-700"><i class="size-2.5 rounded-full bg-sky-500"></i>Erkek</span><strong>{{ number_format($stats['male_users']) }} <small class="font-medium text-neutral-400">(%{{ $malePercent }})</small></strong></div>
            </div>
            <a href="{{ route('admin.users') }}" class="mt-7 flex items-center justify-center rounded-xl bg-neutral-950 px-4 py-3 text-xs font-bold text-white transition hover:bg-neutral-800">Kullanıcıları yönet</a>
        </section>
    </div>

    <div class="mt-6 grid gap-6 lg:grid-cols-2">
        <section class="rounded-2xl border border-neutral-200/80 bg-white p-5 shadow-sm sm:p-6" aria-labelledby="recent-posts-title">
            <div class="flex items-center justify-between"><h2 id="recent-posts-title" class="text-base font-black text-neutral-950">Son gönderiler</h2><a href="{{ route('admin.posts') }}" class="text-xs font-bold text-brand-700">Moderasyon →</a></div>
            <div class="mt-5 space-y-3">
                @forelse ($stats['recent_posts'] as $post)
                    <div class="flex items-center gap-3 rounded-xl bg-neutral-50 p-3">
                        <span class="grid size-9 shrink-0 place-items-center rounded-xl bg-white text-neutral-500 shadow-sm"><svg viewBox="0 0 24 24" class="size-4" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M4 19.5V5a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v14.5M8 7h8M8 11h8M8 15h5"/></svg></span>
                        <span class="min-w-0 flex-1"><span class="block truncate text-sm font-bold">{{ $post->title }}</span><span class="block text-xs text-neutral-500">{{ $post->user?->name ?? 'Silinmiş kullanıcı' }} · {{ $post->created_at?->diffForHumans() ?? '—' }}</span></span>
                        <span class="rounded-full px-2.5 py-1 text-[0.65rem] font-bold {{ $post->status === 'published' ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700' }}">{{ $post->status === 'published' ? 'Yayında' : 'Taslak' }}</span>
                    </div>
                @empty
                    <p class="py-8 text-center text-sm text-neutral-500">Henüz gönderi bulunmuyor.</p>
                @endforelse
            </div>
        </section>

        <section class="rounded-2xl border border-neutral-200/80 bg-white p-5 shadow-sm sm:p-6" aria-labelledby="cities-title">
            <h2 id="cities-title" class="text-base font-black text-neutral-950">En yoğun şehirler</h2><p class="mt-1 text-xs text-neutral-500">Üye sayısına göre ilk beş şehir</p>
            <div class="mt-5 space-y-3">
                @forelse ($stats['top_cities'] as $city)
                    <div class="flex items-center gap-3"><span class="grid size-9 place-items-center rounded-xl bg-brand-50 text-brand-700"><svg viewBox="0 0 24 24" class="size-4" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M12 21s7-5.1 7-11a7 7 0 1 0-14 0c0 5.9 7 11 7 11Z"/><circle cx="12" cy="10" r="2"/></svg></span><span class="flex-1 text-sm font-bold">{{ $city->city }}</span><span class="text-xs font-bold text-neutral-500">{{ $city->total }} üye</span></div>
                @empty
                    <p class="py-8 text-center text-sm text-neutral-500">Şehir bilgisi bulunan üye yok.</p>
                @endforelse
            </div>
        </section>
    </div>
</x-admin.layout>
