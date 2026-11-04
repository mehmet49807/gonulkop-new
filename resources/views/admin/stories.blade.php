<x-admin.layout title="Hikâyeler" description="Platformdaki tüm hikâyeleri inceleyin ve moderasyon yapın.">
    <section class="rounded-2xl border border-neutral-200/80 bg-white p-4 shadow-sm sm:p-5">
        <form method="GET" action="{{ route('admin.stories') }}" class="grid gap-3 sm:grid-cols-[minmax(16rem,1fr)_auto]">
            <label class="relative block">
                <span class="sr-only">Hikâye ara</span>
                <svg viewBox="0 0 24 24" class="pointer-events-none absolute left-3.5 top-1/2 size-4 -translate-y-1/2 text-neutral-400" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
                <input type="search" name="search" value="{{ request('search') }}" placeholder="Başlık, içerik veya kullanıcı" class="h-11 w-full rounded-xl border border-neutral-200 bg-neutral-50 pl-10 pr-4 text-sm outline-none focus:border-brand-400 focus:bg-white focus:ring-3 focus:ring-brand-100">
            </label>
            <div class="flex gap-2">
                <button type="submit" class="h-11 rounded-xl bg-neutral-950 px-5 text-sm font-bold text-white">Ara</button>
                @if (request('search'))
                    <a href="{{ route('admin.stories') }}" class="grid size-11 place-items-center rounded-xl border border-neutral-200 text-neutral-500">×</a>
                @endif
            </div>
        </form>
    </section>

    <section class="mt-5 overflow-hidden rounded-2xl border border-neutral-200/80 bg-white shadow-sm">
        <div class="border-b border-neutral-100 px-5 py-4">
            <h2 class="text-sm font-black text-neutral-950">Hikâye listesi</h2>
            <p class="mt-1 text-xs text-neutral-500">{{ number_format($stories->total()) }} hikâye</p>
        </div>
        <div class="divide-y divide-neutral-100">
            @forelse ($stories as $story)
                <div class="flex flex-col gap-3 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
                    <div class="min-w-0 flex-1">
                        <p class="truncate text-sm font-bold text-neutral-950">{{ $story->title ?: 'Başlıksız hikâye' }}</p>
                        <p class="mt-1 line-clamp-2 text-xs text-neutral-500">{{ $story->content }}</p>
                        <p class="mt-2 text-xs text-neutral-400">
                            {{ $story->user?->name ?? 'Silinmiş kullanıcı' }}
                            · {{ $story->created_at?->diffForHumans() ?? '—' }}
                            @if ($story->expires_at)
                                · Bitiş: {{ $story->expires_at->format('d.m.Y H:i') }}
                            @endif
                        </p>
                    </div>
                    <form method="POST" action="{{ route('admin.stories.destroy', $story->id) }}" onsubmit="return confirm('Bu hikâyeyi silmek istediğinize emin misiniz?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="rounded-xl border border-red-200 bg-red-50 px-4 py-2 text-xs font-bold text-red-700 hover:bg-red-100">Sil</button>
                    </form>
                </div>
            @empty
                <p class="px-5 py-12 text-center text-sm text-neutral-500">Henüz hikâye bulunmuyor.</p>
            @endforelse
        </div>
        @if ($stories->hasPages())
            <div class="border-t border-neutral-100 px-5 py-4">{{ $stories->links() }}</div>
        @endif
    </section>
</x-admin.layout>
