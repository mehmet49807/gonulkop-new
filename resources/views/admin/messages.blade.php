<x-admin.layout title="Mesajlar" description="Gönül Köprüsü mesaj trafiğini güvenli biçimde inceleyin.">
    <section class="rounded-2xl border border-neutral-200/80 bg-white p-4 shadow-sm sm:p-5">
        <form method="GET" action="{{ route('admin.messages') }}" class="flex flex-col gap-3 sm:flex-row">
            <label class="relative block flex-1"><span class="sr-only">Mesaj ara</span><svg viewBox="0 0 24 24" class="pointer-events-none absolute left-3.5 top-1/2 size-4 -translate-y-1/2 text-neutral-400" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg><input type="search" name="search" value="{{ request('search') }}" placeholder="Mesaj içeriği veya katılımcı adı" class="h-11 w-full rounded-xl border border-neutral-200 bg-neutral-50 pl-10 pr-4 text-sm outline-none focus:border-brand-400 focus:bg-white focus:ring-3 focus:ring-brand-100"></label>
            <button type="submit" class="h-11 rounded-xl bg-neutral-950 px-6 text-sm font-bold text-white">Ara</button>
            @if (request('search'))<a href="{{ route('admin.messages') }}" class="grid size-11 place-items-center rounded-xl border border-neutral-200 text-neutral-500">×</a>@endif
        </form>
    </section>

    <div class="mt-5 flex items-center justify-between gap-4">
        <div><h2 class="text-base font-black text-neutral-950">Mesaj denetim kaydı</h2><p class="mt-1 text-xs text-neutral-500">Toplam {{ number_format($messages->total()) }} mesaj</p></div>
        <span class="rounded-full bg-violet-50 px-3 py-1.5 text-xs font-bold text-violet-700">Denetim amaçlı</span>
    </div>

    <section class="mt-4 overflow-hidden rounded-2xl border border-neutral-200/80 bg-white shadow-sm">
        <div class="divide-y divide-neutral-100">
            @forelse ($messages as $message)
                <article class="grid gap-4 p-5 lg:grid-cols-[minmax(0,1fr)_10rem_auto] lg:items-center">
                    <div class="min-w-0">
                        <div class="flex flex-wrap items-center gap-2">
                            <p class="text-sm font-bold text-neutral-900">{{ $message->sender?->name ?? 'Silinmiş kullanıcı' }}</p>
                            <span class="text-xs text-neutral-400">→</span>
                            <p class="text-sm font-semibold text-neutral-600">{{ $message->recipient?->name ?? 'Silinmiş kullanıcı' }}</p>
                            <span class="rounded-full px-2.5 py-1 text-[0.65rem] font-bold {{ $message->read_at ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700' }}">{{ $message->read_at ? 'Okundu' : 'Okunmadı' }}</span>
                        </div>
                        <p class="mt-3 rounded-xl bg-neutral-50 p-3 text-sm leading-6 text-neutral-700">{{ $message->content }}</p>
                    </div>
                    <div class="text-xs">
                        <p class="font-semibold text-neutral-600">{{ $message->created_at?->format('d.m.Y H:i') ?? '—' }}</p>
                        <p class="mt-1 text-neutral-400">{{ $message->created_at?->diffForHumans() ?? '—' }}</p>
                    </div>
                    <form method="POST" action="{{ route('admin.messages.destroy', $message->id) }}" onsubmit="return confirm('Bu mesaj silinecek. Devam?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="rounded-xl border border-red-200 bg-red-50 px-4 py-2 text-xs font-bold text-red-700 hover:bg-red-100">Sil</button>
                    </form>
                </article>
            @empty
                <div class="px-5 py-16 text-center">
                    <p class="text-sm font-bold text-neutral-800">Mesaj bulunamadı</p>
                    <p class="mt-1 text-xs text-neutral-500">Arama terimini değiştirerek tekrar deneyin.</p>
                </div>
            @endforelse
        </div>
        @if ($messages->hasPages())<div class="border-t border-neutral-100 px-5 py-4">{{ $messages->links() }}</div>@endif
    </section>
</x-admin.layout>
