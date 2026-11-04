<x-admin.layout title="Süper Beğeniler" description="Üyeler arası süper beğeni kayıtlarını yönetin.">
    <section class="overflow-hidden rounded-2xl border border-neutral-200/80 bg-white shadow-sm">
        <div class="border-b border-neutral-100 px-5 py-4">
            <h2 class="text-sm font-black text-neutral-950">Süper beğeni listesi</h2>
            <p class="mt-1 text-xs text-neutral-500">{{ number_format($superLikes->total()) }} kayıt</p>
        </div>
        <div class="divide-y divide-neutral-100">
            @forelse ($superLikes as $like)
                <div class="flex flex-col gap-3 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-bold text-neutral-950">
                            {{ $like->user?->name ?? 'Silinmiş' }}
                            <span class="font-normal text-neutral-400">→</span>
                            {{ $like->likedUser?->name ?? 'Silinmiş' }}
                        </p>
                        <p class="mt-1 text-xs text-neutral-400">{{ $like->created_at?->diffForHumans() ?? '—' }}</p>
                    </div>
                    <form method="POST" action="{{ route('admin.super-likes.destroy', $like->id) }}" onsubmit="return confirm('Bu kaydı silmek istediğinize emin misiniz?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="rounded-xl border border-red-200 bg-red-50 px-4 py-2 text-xs font-bold text-red-700 hover:bg-red-100">Sil</button>
                    </form>
                </div>
            @empty
                <p class="px-5 py-12 text-center text-sm text-neutral-500">Henüz süper beğeni yok.</p>
            @endforelse
        </div>
        @if ($superLikes->hasPages())
            <div class="border-t border-neutral-100 px-5 py-4">{{ $superLikes->links() }}</div>
        @endif
    </section>
</x-admin.layout>
