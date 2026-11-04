<x-admin.layout title="Kullanıcılar" description="Gönülkop üye hesaplarını arayın, filtreleyin ve yönetin.">
    <section class="rounded-2xl border border-neutral-200/80 bg-white p-4 shadow-sm sm:p-5">
        <form method="GET" action="{{ route('admin.users') }}" class="grid gap-3 lg:grid-cols-[minmax(16rem,1fr)_11rem_13rem_auto]">
            <label class="relative block"><span class="sr-only">Kullanıcı ara</span><svg viewBox="0 0 24 24" class="pointer-events-none absolute left-3.5 top-1/2 size-4 -translate-y-1/2 text-neutral-400" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg><input type="search" name="search" value="{{ request('search') }}" placeholder="İsim, kullanıcı adı, e-posta veya şehir" class="h-11 w-full rounded-xl border border-neutral-200 bg-neutral-50 pl-10 pr-4 text-sm font-medium outline-none transition placeholder:text-neutral-400 focus:border-brand-400 focus:bg-white focus:ring-3 focus:ring-brand-100"></label>
            <label><span class="sr-only">Cinsiyet</span><select name="gender" class="h-11 w-full rounded-xl border border-neutral-200 bg-neutral-50 px-3 text-sm font-semibold text-neutral-700 outline-none focus:border-brand-400 focus:ring-3 focus:ring-brand-100"><option value="">Tüm cinsiyetler</option><option value="female" @selected(request('gender') === 'female')>Kadın</option><option value="male" @selected(request('gender') === 'male')>Erkek</option></select></label>
            <label><span class="sr-only">Üyelik durumu</span><select name="membership" class="h-11 w-full rounded-xl border border-neutral-200 bg-neutral-50 px-3 text-sm font-semibold text-neutral-700 outline-none focus:border-brand-400 focus:ring-3 focus:ring-brand-100"><option value="">Tüm üyelikler</option><option value="premium" @selected(request('membership') === 'premium')>Premium</option><option value="free" @selected(request('membership') === 'free')>Ücretsiz</option><option value="admin" @selected(request('membership') === 'admin')>Yönetici</option></select></label>
            <div class="flex gap-2"><button type="submit" class="h-11 rounded-xl bg-neutral-950 px-5 text-sm font-bold text-white transition hover:bg-neutral-800">Filtrele</button>@if (request()->hasAny(['search', 'gender', 'membership']))<a href="{{ route('admin.users') }}" class="grid size-11 place-items-center rounded-xl border border-neutral-200 text-neutral-500" aria-label="Filtreleri temizle">×</a>@endif</div>
        </form>
    </section>

    <section class="mt-5 overflow-hidden rounded-2xl border border-neutral-200/80 bg-white shadow-sm">
        <div class="flex items-center justify-between gap-4 border-b border-neutral-100 px-5 py-4"><div><h2 class="text-sm font-black text-neutral-950">Üye listesi</h2><p class="mt-1 text-xs text-neutral-500">{{ number_format($users->total()) }} kayıt bulundu</p></div><span class="rounded-full bg-brand-50 px-3 py-1.5 text-xs font-bold text-brand-700">{{ $users->firstItem() ?? 0 }}–{{ $users->lastItem() ?? 0 }}</span></div>

        <div class="hidden overflow-x-auto md:block">
            <table class="w-full min-w-[760px] text-left">
                <thead class="bg-neutral-50/80 text-[0.65rem] font-bold uppercase tracking-[0.14em] text-neutral-400"><tr><th class="px-5 py-3.5">Üye</th><th class="px-5 py-3.5">Konum</th><th class="px-5 py-3.5">Durum</th><th class="px-5 py-3.5">Kayıt</th><th class="px-5 py-3.5 text-right">İşlem</th></tr></thead>
                <tbody class="divide-y divide-neutral-100">
                    @forelse ($users as $user)
                        <tr class="transition hover:bg-neutral-50/70">
                            <td class="px-5 py-4"><a href="{{ route('admin.users.show', $user) }}" class="flex items-center gap-3"><x-ui.avatar :src="$user->avatar_url" :name="$user->name" size="sm" /><span class="min-w-0"><span class="block truncate text-sm font-bold text-neutral-900">{{ $user->name }}</span><span class="block truncate text-xs text-neutral-500">{{ $user->email }}</span></span></a></td>
                            <td class="px-5 py-4"><p class="text-sm font-semibold text-neutral-700">{{ $user->city ?: 'Belirtilmemiş' }}</p><p class="mt-0.5 text-xs text-neutral-400">{{ $user->gender?->value === 'female' ? 'Kadın' : ($user->gender?->value === 'male' ? 'Erkek' : 'Belirtilmemiş') }}</p></td>
                            <td class="px-5 py-4"><div class="flex flex-wrap gap-1.5">@if ($user->is_premium)<span class="rounded-full bg-amber-50 px-2.5 py-1 text-[0.65rem] font-bold text-amber-700">Premium</span>@else<span class="rounded-full bg-neutral-100 px-2.5 py-1 text-[0.65rem] font-bold text-neutral-600">Ücretsiz</span>@endif @if ($user->is_admin)<span class="rounded-full bg-neutral-950 px-2.5 py-1 text-[0.65rem] font-bold text-white">Yönetici</span>@endif</div></td>
                            <td class="px-5 py-4 text-xs font-medium text-neutral-500">{{ $user->created_at->format('d.m.Y') }}</td>
                            <td class="px-5 py-4"><div class="flex justify-end gap-1"><a href="{{ route('admin.users.show', $user) }}" class="grid size-9 place-items-center rounded-xl text-neutral-400 transition hover:bg-brand-50 hover:text-brand-700" aria-label="{{ $user->name }} detayını aç"><svg viewBox="0 0 24 24" class="size-4" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/><circle cx="12" cy="12" r="3"/></svg></a>@unless ($user->is_admin)<form method="POST" action="{{ route('admin.users.destroy', $user) }}" data-confirm="{{ $user->name }} hesabı kalıcı olarak silinecek. Devam edilsin mi?" class="inline">@csrf @method('DELETE')<button type="submit" class="grid size-9 place-items-center rounded-xl text-neutral-400 transition hover:bg-red-50 hover:text-red-600" aria-label="{{ $user->name }} hesabını sil"><svg viewBox="0 0 24 24" class="size-4" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M3 6h18M8 6V4h8v2M19 6l-1 15H6L5 6M10 11v5M14 11v5"/></svg></button></form>@endunless</div></td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-5 py-16 text-center"><span class="mx-auto grid size-12 place-items-center rounded-2xl bg-neutral-100 text-neutral-400"><svg viewBox="0 0 24 24" class="size-6" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg></span><p class="mt-4 text-sm font-bold text-neutral-800">Kullanıcı bulunamadı</p><p class="mt-1 text-xs text-neutral-500">Filtreleri değiştirerek tekrar deneyin.</p></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="divide-y divide-neutral-100 md:hidden">
            @forelse ($users as $user)
                <article class="p-4"><div class="flex items-start gap-3"><x-ui.avatar :src="$user->avatar_url" :name="$user->name" size="sm" /><div class="min-w-0 flex-1"><a href="{{ route('admin.users.show', $user) }}" class="block truncate text-sm font-bold">{{ $user->name }}</a><p class="truncate text-xs text-neutral-500">{{ $user->email }}</p><p class="mt-1 text-xs text-neutral-400">{{ $user->city ?: 'Şehir belirtilmemiş' }} · {{ $user->created_at->format('d.m.Y') }}</p></div><a href="{{ route('admin.users.show', $user) }}" class="grid size-9 shrink-0 place-items-center rounded-xl bg-neutral-50 text-neutral-500">›</a></div><div class="mt-3 flex gap-2">@if ($user->is_premium)<span class="rounded-full bg-amber-50 px-2.5 py-1 text-[0.65rem] font-bold text-amber-700">Premium</span>@endif @if ($user->is_admin)<span class="rounded-full bg-neutral-950 px-2.5 py-1 text-[0.65rem] font-bold text-white">Yönetici</span>@endif</div></article>
            @empty
                <p class="px-4 py-14 text-center text-sm text-neutral-500">Kullanıcı bulunamadı.</p>
            @endforelse
        </div>
        @if ($users->hasPages())<div class="border-t border-neutral-100 px-5 py-4">{{ $users->links() }}</div>@endif
    </section>
</x-admin.layout>

