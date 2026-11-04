<x-layouts.app
    title="Tasarım Önizleme"
    description="Gönülkop mobil arayüz tasarım sistemi"
    show-navigation
>
    <x-slot:header>
        <div class="border-t border-line/60 bg-canvas/70 px-4 py-3 sm:px-5">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="text-xs font-semibold tracking-[0.16em] text-brand-600 uppercase">Tasarım sistemi</p>
                    <h1 class="mt-1 text-lg font-semibold tracking-tight text-ink">Gönülkop UI Önizleme</h1>
                </div>
                <span class="rounded-full border border-brand-200 bg-brand-50 px-3 py-1 text-xs font-semibold text-brand-700">Tailwind v4</span>
            </div>
        </div>
    </x-slot:header>

    <div class="space-y-5 bg-canvas/50 p-3 sm:p-5">
        <x-feed.story-strip :stories="[
            ['name' => 'Elif', 'image' => null],
            ['name' => 'Mert', 'image' => null],
            ['name' => 'Deniz', 'image' => null],
            ['name' => 'Selin', 'image' => null],
            ['name' => 'Arda', 'image' => null],
        ]" />

        <section aria-labelledby="feed-card-title">
            <div class="mb-3 flex items-end justify-between gap-4 px-1">
                <div>
                    <p class="text-xs font-semibold tracking-[0.14em] text-brand-600 uppercase">Akış</p>
                    <h2 id="feed-card-title" class="mt-1 text-base font-semibold text-ink">Gönderi kartı</h2>
                </div>
                <span class="text-xs text-muted">Mobile-first</span>
            </div>

            <x-feed.post-card
                author-name="Mert Yılmaz"
                title="İstanbul'da yeni bir başlangıç"
                content="Gün batımını seyretmek için yeni bir favori keşfettim. Şehrin sakin tarafında, kalabalıktan uzak küçük bir köşe buldum."
                published-at="2 saat önce"
                :like-count="248"
                :comment-count="18"
            />
        </section>

        <section class="surface-card p-5" aria-labelledby="form-title">
            <p class="text-xs font-semibold tracking-[0.14em] text-brand-600 uppercase">Form</p>
            <h2 id="form-title" class="mt-1 text-base font-semibold text-ink">Kayıt alanları</h2>

            <div class="mt-5 grid gap-5">
                <x-ui.form-field name="preview_name" label="Ad Soyad" required>
                    <input id="preview_name" name="preview_name" type="text" class="form-control" placeholder="Örn. Elif Yılmaz">
                </x-ui.form-field>

                <x-ui.form-field name="preview_city" label="Şehir">
                    <select id="preview_city" name="preview_city" class="form-control">
                        <option>İstanbul</option>
                        <option>Ankara</option>
                        <option>İzmir</option>
                    </select>
                </x-ui.form-field>

                <x-ui.form-field name="preview_bio" label="Biyografi" hint="0/300">
                    <textarea id="preview_bio" name="preview_bio" rows="3" class="form-control resize-none" placeholder="Kendinden kısaca bahset..."></textarea>
                </x-ui.form-field>

                <div class="flex flex-col gap-3 sm:flex-row">
                    <x-ui.button class="w-full sm:w-auto">Devam Et</x-ui.button>
                    <x-ui.button variant="secondary" class="w-full sm:w-auto">İptal</x-ui.button>
                </div>
            </div>
        </section>

        <section class="surface-card overflow-hidden" aria-labelledby="empty-title">
            <x-ui.empty-state
                title="Henüz yeni hikâye yok"
                description="Tanıdığın kişilerin hikâyeleri burada görünecek. Keşfet bölümünden yeni bağlantılar kurabilirsin."
                icon="message"
            >
                <x-ui.button variant="secondary" size="sm">Keşfetmeye Başla</x-ui.button>
            </x-ui.empty-state>
        </section>

        <section class="surface-card p-5" aria-labelledby="premium-title">
            <p class="text-xs font-semibold tracking-[0.14em] text-brand-600 uppercase">Premium</p>
            <h2 id="premium-title" class="mt-1 text-base font-semibold text-ink">Deneme sonu uyarısı</h2>
            <p class="mt-2 text-sm leading-6 text-muted">Mesaj gönderme kısıtını backend ile birleştireceğimiz modal tasarımı.</p>
            <x-ui.button class="mt-4" data-dialog-open="#premium-dialog">Modalı Görüntüle</x-ui.button>
        </section>
    </div>

    @push('modals')
        <x-ui.premium-dialog />
    @endpush
</x-layouts.app>
