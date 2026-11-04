<x-admin.layout title="Sistem Ayarları" description="Gönül Köprüsü platform durumu ve yönetim özeti.">
    <div class="grid gap-5 lg:grid-cols-[minmax(0,1.4fr)_22rem]">
        <section class="overflow-hidden rounded-2xl border border-neutral-200/80 bg-neutral-50 shadow-sm">
            <div class="border-b border-neutral-200/80 bg-white px-5 py-4">
                <h2 class="text-sm font-black text-neutral-950">Platform özeti</h2>
                <p class="mt-1 text-xs text-neutral-500">Canlı sistem bilgileri</p>
            </div>
            <dl class="grid gap-px bg-neutral-200/60 sm:grid-cols-2">
                <div class="bg-white p-5"><dt class="text-xs font-semibold text-neutral-400">Site adı</dt><dd class="mt-2 text-sm font-black text-neutral-900">{{ $system['site_name'] }}</dd></div>
                <div class="bg-white p-5"><dt class="text-xs font-semibold text-neutral-400">Site URL</dt><dd class="mt-2 truncate text-sm font-black text-neutral-900">{{ $system['site_url'] }}</dd></div>
                <div class="bg-white p-5"><dt class="text-xs font-semibold text-neutral-400">Ortam</dt><dd class="mt-2 text-sm font-black capitalize text-neutral-900">{{ $system['environment'] }}</dd></div>
                <div class="bg-white p-5"><dt class="text-xs font-semibold text-neutral-400">Veritabanı</dt><dd class="mt-2 text-sm font-black capitalize text-neutral-900">{{ $system['database'] }}</dd></div>
                <div class="bg-white p-5"><dt class="text-xs font-semibold text-neutral-400">PHP</dt><dd class="mt-2 text-sm font-black text-neutral-900">{{ $system['php_version'] }}</dd></div>
                <div class="bg-white p-5"><dt class="text-xs font-semibold text-neutral-400">Laravel</dt><dd class="mt-2 text-sm font-black text-neutral-900">{{ $system['laravel_version'] }}</dd></div>
                <div class="bg-white p-5"><dt class="text-xs font-semibold text-neutral-400">Kayıtlı üye</dt><dd class="mt-2 text-sm font-black text-neutral-900">{{ number_format($system['registered_users']) }}</dd></div>
                <div class="bg-white p-5"><dt class="text-xs font-semibold text-neutral-400">Premium üye</dt><dd class="mt-2 text-sm font-black text-neutral-900">{{ number_format($system['premium_users']) }}</dd></div>
                <div class="bg-white p-5"><dt class="text-xs font-semibold text-neutral-400">Yayındaki gönderi</dt><dd class="mt-2 text-sm font-black text-neutral-900">{{ number_format($system['published_posts']) }}</dd></div>
                <div class="bg-white p-5"><dt class="text-xs font-semibold text-neutral-400">Hikâye</dt><dd class="mt-2 text-sm font-black text-neutral-900">{{ number_format($system['total_stories']) }}</dd></div>
                <div class="bg-white p-5"><dt class="text-xs font-semibold text-neutral-400">Mesaj</dt><dd class="mt-2 text-sm font-black text-neutral-900">{{ number_format($system['total_messages']) }}</dd></div>
                <div class="bg-white p-5"><dt class="text-xs font-semibold text-neutral-400">Süper beğeni</dt><dd class="mt-2 text-sm font-black text-neutral-900">{{ number_format($system['total_super_likes']) }}</dd></div>
                <div class="bg-white p-5"><dt class="text-xs font-semibold text-neutral-400">Erkek deneme süresi</dt><dd class="mt-2 text-sm font-black text-neutral-900">{{ $system['trial_days'] }} gün</dd></div>
            </dl>
        </section>

        <aside class="space-y-5">
            <section class="rounded-2xl bg-neutral-950 p-5 text-white shadow-xl shadow-neutral-900/10">
                <h2 class="text-base font-black">Yönetici oturumu</h2>
                <p class="mt-2 text-sm leading-6 text-neutral-400">Bu panel üye oturumundan bağımsızdır.</p>
                <div class="mt-4 rounded-xl bg-white/5 p-3">
                    <p class="text-[0.65rem] font-bold uppercase tracking-[0.12em] text-neutral-500">Yönetici</p>
                    <p class="mt-1 truncate text-xs font-semibold text-neutral-200">{{ $system['admin_email'] ?? 'Belirtilmemiş' }}</p>
                </div>
            </section>
            <section class="rounded-2xl border border-neutral-200 bg-white p-5 shadow-sm">
                <h2 class="text-sm font-black text-neutral-950">Hızlı erişim</h2>
                <ul class="mt-3 space-y-2 text-sm">
                    <li><a href="{{ route('admin.users') }}" class="font-semibold text-brand-700 hover:underline">Kullanıcı yönetimi →</a></li>
                    <li><a href="{{ route('admin.posts') }}" class="font-semibold text-brand-700 hover:underline">Gönderi moderasyonu →</a></li>
                    <li><a href="{{ route('admin.stories') }}" class="font-semibold text-brand-700 hover:underline">Hikâye moderasyonu →</a></li>
                    <li><a href="{{ route('admin.messages') }}" class="font-semibold text-brand-700 hover:underline">Mesaj denetimi →</a></li>
                </ul>
            </section>
            <section class="rounded-2xl border border-amber-200 bg-amber-50 p-5">
                <h2 class="text-sm font-black text-amber-900">Güvenlik notu</h2>
                <p class="mt-2 text-xs leading-5 text-amber-800">Admin şifresini düzenli değiştirin. Son yönetici hesabını silmeyin.</p>
            </section>
        </aside>
    </div>
</x-admin.layout>
