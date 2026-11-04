<x-admin.layout title="Gönderiler" description="Gönül Köprüsü gönderilerini inceleyin ve moderasyon işlemlerini yönetin.">
    <section class="rounded-2xl border border-neutral-200/80 bg-white p-4 shadow-sm sm:p-5">
        <form method="GET" action="{{ route('admin.posts') }}" class="grid gap-3 sm:grid-cols-[minmax(16rem,1fr)_12rem_auto]">
            <label class="relative block"><span class="sr-only">Gönderi ara</span><svg viewBox="0 0 24 24" class="pointer-events-none absolute left-3.5 top-1/2 size-4 -translate-y-1/2 text-neutral-400" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg><input type="search" name="search" value="{{ request('search') }}" placeholder="Başlık, içerik veya kullanıcı adı" class="h-11 w-full rounded-xl border border-neutral-200 bg-neutral-50 pl-10 pr-4 text-sm outline-none focus:border-brand-400 focus:bg-white focus:ring-3 focus:ring-brand-100"></label>
            <label><span class="sr-only">Yayın durumu</span><select name="status" class="h-11 w-full rounded-xl border border-neutral-200 bg-neutral-50 px-3 text-sm font-semibold outline-none focus:border-brand-400 focus:ring-3 focus:ring-brand-100"><option value="">Tüm durumlar</option><option value="published" @selected(request('status') === 'published')>Yayında</option><option value="draft" @selected(request('status') === 'draft')>Taslak</option></select></label>
            <div class="flex gap-2"><button type="submit" class="h-11 rounded-xl bg-neutral-950 px-5 text-sm font-bold text-white">Filtrele</button>@if (request()->hasAny(['search', 'status']))<a href="{{ route('admin.posts') }}" class="grid size-11 place-items-center rounded-xl border border-neutral-200 text-neutral-500">×</a>@endif</div>
        </form>
    </section>

    <section class="mt-5 overflow-hidden rounded-2xl border border-neutral-200/80 bg-white shadow-sm">
        <div class="border-b border-neutral-100 px-5 py-4"><h2 class="text-sm font-black text-neutral-950">İçerik listesi</h2><p class="mt-1 text-xs text-neutral-500">{{ number_format($posts->total()) }} gönderi</p></div>
        <div class="divide-y divide-neutral-100">
            @forelse ($posts as $post)
                <article class="grid gap-4 p-5 transition hover:bg-neutral-50/60 lg:grid-cols-[minmax(0,1fr)_10rem_auto] lg:items-center">
                    <div class="min-w-0">
                        <div class="flex flex-wrap items-center gap-2">
                            <h3 class="truncate text-sm font-black text-neutral-900">{{ $post->title }}</h3>
                            <span class="rounded-full px-2.5 py-1 text-[0.65rem] font-bold {{ $post->status === 'published' ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700' }}">{{ $post->status === 'published' ? 'Yayında' : 'Taslak' }}</span>
                        </div>
                        <p class="mt-2 line-clamp-2 text-xs leading-5 text-neutral-500">{{ $post->content }}</p>
                        <div class="mt-3 flex items-center gap-2">
                            <span class="text-xs font-semibold text-neutral-600">{{ $post->user?->name ?? 'Silinmiş kullanıcı' }}</span>
                            <span class="text-xs text-neutral-400">· {{ $post->created_at?->diffForHumans() ?? '—' }}</span>
                        </div>
                    </div>
                    <div class="text-xs">
                        <p class="font-semibold text-neutral-600">{{ $post->published_at?->format('d.m.Y H:i') ?? 'Yayınlanmadı' }}</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <form method="POST" action="{{ route('admin.posts.status', $post->id) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="rounded-xl border border-neutral-200 bg-neutral-50 px-3 py-2 text-xs font-bold text-neutral-700 hover:bg-neutral-100">
                                {{ $post->status === 'published' ? 'Taslağa al' : 'Yayınla' }}
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.posts.destroy', $post->id) }}" onsubmit="return confirm('Bu gönderi kalıcı olarak silinecek. Devam edilsin mi?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="grid size-10 place-items-center rounded-xl text-neutral-400 transition hover:bg-red-50 hover:text-red-600" aria-label="Sil">
                                <svg viewBox="0 0 24 24" class="size-4" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M3 6h18M8 6V4h8v2M19 6l-1 15H6L5 6M10 11v5M14 11v5"/></svg>
                            </button>
                        </form>
                    </div>
                </article>
            @empty
                <div class="px-5 py-16 text-center">
                    <p class="text-sm font-bold text-neutral-800">Gönderi bulunamadı</p>
                    <p class="mt-1 text-xs text-neutral-500">Arama veya durum filtresini değiştirin.</p>
                </div>
            @endforelse
        </div>
        @if ($posts->hasPages())<div class="border-t border-neutral-100 px-5 py-4">{{ $posts->links() }}</div>@endif
    </section>
</x-admin.layout>
