<x-layouts.app title="Akış · Gönül Köprüsü" description="Karşıt cinsiyetten profillerin paylaştığı hikâyeler ve gönderiler." show-navigation>
    @php
        $featuredStories = [
            ['name' => 'Elif', 'username' => 'elif_24', 'city' => 'İstanbul', 'image' => null, 'gender' => 'female'],
            ['name' => 'Mert', 'username' => 'mert_istanbul', 'city' => 'İstanbul', 'image' => null, 'gender' => 'male'],
            ['name' => 'Deniz', 'username' => 'deniz_izmir', 'city' => 'İzmir', 'image' => null, 'gender' => 'female'],
            ['name' => 'Selin', 'username' => 'selin_ankara', 'city' => 'Ankara', 'image' => null, 'gender' => 'female'],
            ['name' => 'Arda', 'username' => 'arda_bursa', 'city' => 'Bursa', 'image' => null, 'gender' => 'male'],
        ];
    @endphp

    @guest
    <section class="px-3 sm:px-4 py-6 sm:py-10 animate-fade-up animate-slide-up">
        <div class="glass-card rounded-3xl overflow-hidden relative border border-white/60">
            <div class="absolute -top-1/3 -left-1/3 size-72 bg-brand-100/40 blur-[120px] rounded-full" aria-hidden="true"></div>
            <div class="absolute -bottom-1/3 -right-1/3 size-64 bg-brand-50/30 blur-[100px] rounded-full" aria-hidden="true"></div>
            <div class="relative z-10 px-4 sm:px-6 py-10 sm:py-14 text-center">
                <x-brand-logo size="lg" class="mx-auto mb-8" />
                <h2 class="text-3xl sm:text-5xl font-black tracking-tight text-ink mb-4">Gönül Köprüsü'ne Hoş Geldiniz</h2>
                <p class="text-lg sm:text-xl text-ink-muted mb-12 max-w-2xl mx-auto leading-relaxed">
                    Gönülleri birleştiren köprüyü keşfedin. Yeni kişilerle tanışın, bağlantı kurun ve hikayenizi yazın.
                </p>
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <a href="{{ route('register') }}" class="btn-primary flex-1 sm:flex-1 text-center py-5 text-base font-semibold">Ücretsiz Kayıt Ol</a>
                    <a href="{{ route('login') }}" class="btn-secondary flex-1 sm:flex-1 text-center py-5 text-base font-semibold">Giriş Yap</a>
                </div>
            </div>
        </div>
    </section>
    @endguest

    <!-- Story Bar (Instagram style) -->
    <div class="border-b border-line/80 bg-white/80 backdrop-blur-sm sticky top-0 z-30 pb-2">
        <div class="flex items-center justify-between px-4 sm:px-6 py-3 sm:py-4">
            <div class="flex items-center gap-2">
                <span class="text-xs font-black tracking-[0.18em] uppercase text-neutral-400">Hikâyeler</span>
                <span class="text-[0.625rem] font-medium text-neutral-500">5 aktif</span>
            </div>
            <div class="flex-1 no-scrollbar flex snap-x gap-1 overflow-x-auto px-1 sm:px-2 touch-pan-y overscroll-contain scrollbar-refined" role="list" aria-label="Hikâyeler">
                @foreach ($featuredStories as $story)
                    <a href="#" class="group flex w-12 h-12 shrink-0 snap-start flex-col items-center gap-1" role="listitem">
                        <span class="story-ring grid size-10 place-items-center rounded-full p-[2px] transition group-hover:scale-105">
                            <span class="grid size-full place-items-center rounded-full bg-white p-[1px]">
                                <x-ui.avatar :src="$story['image']" :name="$story['name']" size="xs" class="ring-0" />
                            </span>
                        </span>
                        <span class="w-full truncate text-center text-[0.5625rem] font-medium text-ink">{{ $story['username'] }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Feed Container (Instagram style - centered, single column) -->
    <div class="mx-auto max-w-[614px] px-2 sm:px-3 lg:px-4 py-4 sm:py-6 lg:py-8">
        <div data-feed-infinite data-feed-url="{{ route('feed.api') }}" data-next-url="{{ route('feed.api') }}">
            <div data-feed-posts class="space-y-4 sm:space-y-5 lg:space-y-6">
            <article class="surface-card rounded-xl border border-line/50 overflow-hidden animate-fade-up animate-slide-up">
                <!-- Post Header -->
                <div class="flex items-center justify-between px-4 py-3">
                    <div class="flex items-center gap-3">
                        <x-ui.avatar src="https://ui-avatars.com/api/?name=elif_24&background=random" name="Elif" size="sm" />
                        <div class="min-w-0">
                            <span class="block text-xs font-semibold text-ink">elif_24</span>
                            <span class="block text-[0.625rem] text-ink-muted">İstanbul · 1s</span>
                        </div>
                    </div>
                    <button class="tap-target p-1.5 text-neutral-500 hover:text-brand-600 transition" aria-label="Daha fazla seçenek">
                        <svg viewBox="0 0 24 24" class="size-3.5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="1" /><circle cx="19" cy="12" r="1" /><circle cx="5" cy="12" r="1" /></svg>
                    </button>
                </div>

                <!-- Post Image (Instagram style - 1:1 ratio) -->
                <div class="relative aspect-square bg-neutral-100 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1519233131382-71c6272e96f2?w=800&q=80" alt="Post" class="w-full h-full object-cover opacity-70 grayscale hover:grayscale-0 hover:opacity-100 transition-all duration-300">
                </div>

                <!-- Post Actions (Instagram style - left aligned) -->
                <div class="flex items-center justify-between px-4 py-3">
                    <div class="flex items-center gap-2">
                        <button class="tap-target p-2 text-neutral-500 hover:text-brand-600 transition" aria-label="Beğen">
                            <svg viewBox="0 0 24 24" class="size-4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" /></svg>
                        </button>
                        <button class="tap-target p-2 text-neutral-500 hover:text-ink transition" aria-label="Yorumlar">
                            <svg viewBox="0 0 24 24" class="size-4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 11.5a8.38 8.38 0 0 1-.993 8.382c-.7.366-1.458.54-2.165.54-.796 0-1.548-.243-2.16-.773-.243-.243-.462-.64-.462-1.184V6.283c0-.308.162-.712.524-.964.216-.153.49-.227.767-.227.795 0 1.51.486 2.154.97.361.272.495.729.405 1.155-.077.353-.247.64-.484.863zM9 18a.6.6 0 0 0 0 1.2h.012zm10.628 1.2a.6.6 0 0 0 0-1.2h-.012zM9 16h.012zm10.628 0h-.012z" /></svg>
                        </button>
                        <button class="tap-target p-2 text-neutral-500 hover:text-ink transition" aria-label="Paylaş">
                            <svg viewBox="0 0 24 24" class="size-4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="18" cy="18" r="3" /><circle cx="6" cy="6" r="3" /><line x1="18" y1="6" x2="6" y2="18" /></svg>
                        </button>
                    </div>
                    <button class="tap-target p-2 text-neutral-500 hover:text-ink transition" aria-label="Kaydet">
                        <svg viewBox="0 0 24 24" class="size-4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" /></svg>
                    </button>
                </div>

                <!-- Engagement & Caption -->
                <div class="px-4 py-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-ink">elif_24</span>
                        <span class="text-xs text-ink-muted">2.424 beğeni</span>
                    </div>
                    <p class="text-xs text-ink mt-2 leading-relaxed">
                        <span class="font-semibold text-ink">elif_24</span> Şehrin sakin bir köşesinde yeni bir cafe keşfettim. Burada zaman durmuş gibi hissettim.
                    </p>
                    <p class="text-[0.625rem] text-ink-muted mt-1">2 saat önce</p>
                </div>
            </article>

            <!-- Post 2 -->
            <article class="surface-card rounded-xl border border-line/50 overflow-hidden animate-fade-up animate-slide-up">
                <!-- Post Header -->
                <div class="flex items-center justify-between px-4 py-3">
                    <div class="flex items-center gap-3">
                        <x-ui.avatar src="https://ui-avatars.com/api/?name=mert_istanbul&background=random" name="Mert" size="sm" />
                        <div class="min-w-0">
                            <span class="block text-xs font-semibold text-ink">mert_istanbul</span>
                            <span class="block text-[0.625rem] text-ink-muted">İstanbul · 3s</span>
                        </div>
                    </div>
                    <button class="tap-target p-1.5 text-neutral-500 hover:text-brand-600 transition" aria-label="Daha fazla seçenek">
                        <svg viewBox="0 0 24 24" class="size-3.5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="1" /><circle cx="19" cy="12" r="1" /><circle cx="5" cy="12" r="1" /></svg>
                    </button>
                </div>

                <!-- Post Image (Instagram style - 1:1 ratio) -->
                <div class="relative aspect-square bg-neutral-100 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&q=80" alt="Post" class="w-full h-full object-cover opacity-70 grayscale hover:grayscale-0 hover:opacity-100 transition-all duration-300">
                </div>

                <!-- Post Actions (Instagram style - left aligned) -->
                <div class="flex items-center justify-between px-4 py-3">
                    <div class="flex items-center gap-2">
                        <button class="tap-target p-2 text-neutral-500 hover:text-brand-600 transition" aria-label="Beğen">
                            <svg viewBox="0 0 24 24" class="size-4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" /></svg>
                        </button>
                        <button class="tap-target p-2 text-neutral-500 hover:text-ink transition" aria-label="Yorumlar">
                            <svg viewBox="0 0 24 24" class="size-4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 11.5a8.38 8.38 0 0 1-.993 8.382c-.7.366-1.458.54-2.165.54-.796 0-1.548-.243-2.16-.773-.243-.243-.462-.64-.462-1.184V6.283c0-.308.162-.712.524-.964.216-.153.49-.227.767-.227.795 0 1.51.486 2.154.97.361.272.495.729.405 1.155-.077.353-.247.64-.484.863zM9 18a.6.6 0 0 0 0 1.2h.012zm10.628 1.2a.6.6 0 0 0 0-1.2h-.012zM9 16h.012zm10.628 0h-.012z" /></svg>
                        </button>
                        <button class="tap-target p-2 text-neutral-500 hover:text-ink transition" aria-label="Paylaş">
                            <svg viewBox="0 0 24 24" class="size-4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="18" cy="18" r="3" /><circle cx="6" cy="6" r="3" /><line x1="18" y1="6" x2="6" y2="18" /></svg>
                        </button>
                    </div>
                    <button class="tap-target p-2 text-neutral-500 hover:text-ink transition" aria-label="Kaydet">
                        <svg viewBox="0 0 24 24" class="size-4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" /></svg>
                    </button>
                </div>

                <!-- Engagement & Caption -->
                <div class="px-4 py-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-ink">mert_istanbul</span>
                        <span class="text-xs text-ink-muted">842 beğeni</span>
                    </div>
                    <p class="text-xs text-ink mt-2 leading-relaxed">
                        <span class="font-semibold text-ink">mert_istanbul</span> Sabah yoga oturumu bitince her şey farklı görünüyor. Ruh sağlığı için kaçınılmaz.
                    </p>
                    <p class="text-[0.625rem] text-ink-muted mt-1">3 saat önce</p>
                </div>
            </article>
            </article>

            <!-- Post 3 -->
            <article class="surface-card rounded-xl border border-line/50 overflow-hidden animate-fade-up animate-slide-up">
                <!-- Post Header -->
                <div class="flex items-center justify-between px-4 py-3">
                    <div class="flex items-center gap-3">
                        <x-ui.avatar src="https://ui-avatars.com/api/?name=deniz_izmir&background=random" name="Deniz" size="sm" />
                        <div class="min-w-0">
                            <span class="block text-xs font-semibold text-ink">deniz_izmir</span>
                            <span class="block text-[0.625rem] text-ink-muted">İzmir · 5s</span>
                        </div>
                    </div>
                    <button class="tap-target p-1.5 text-neutral-500 hover:text-brand-600 transition" aria-label="Daha fazla seçenek">
                        <svg viewBox="0 0 24 24" class="size-3.5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="1" /><circle cx="19" cy="12" r="1" /><circle cx="5" cy="12" r="1" /></svg>
                    </button>
                </div>

                <!-- Post Image (Instagram style - 1:1 ratio) -->
                <div class="relative aspect-square bg-neutral-100 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1534438327276-14e5364c3645?w=800&q=80" alt="Post" class="w-full h-full object-cover opacity-70 grayscale hover:grayscale-0 hover:opacity-100 transition-all duration-300">
                </div>

                <!-- Post Actions (Instagram style - left aligned) -->
                <div class="flex items-center justify-between px-4 py-3">
                    <div class="flex items-center gap-2">
                        <button class="tap-target p-2 text-neutral-500 hover:text-brand-600 transition" aria-label="Beğen">
                            <svg viewBox="0 0 24 24" class="size-4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" /></svg>
                        </button>
                        <button class="tap-target p-2 text-neutral-500 hover:text-ink transition" aria-label="Yorumlar">
            </article>

            <!-- Post 4 -->
            <article class="surface-card rounded-xl border border-line/50 overflow-hidden animate-fade-up animate-slide-up">
                <!-- Post Header -->
                <div class="flex items-center justify-between px-4 py-3">
                    <div class="flex items-center gap-3">
                        <x-ui.avatar src="https://ui-avatars.com/api/?name=selin_ankara&background=random" name="Selin" size="sm" />
                        <div class="min-w-0">
                            <span class="block text-xs font-semibold text-ink">selin_ankara</span>
                            <span class="block text-[0.625rem] text-ink-muted">Ankara · 1g</span>
                        </div>
                    </div>
                    <button class="tap-target p-1.5 text-neutral-500 hover:text-brand-600 transition" aria-label="Daha fazla seçenek">
                        <svg viewBox="0 0 24 24" class="size-3.5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="1" /><circle cx="19" cy="12" r="1" /><circle cx="5" cy="12" r="1" /></svg>
                    </button>
                </div>

                <!-- Post Image (Instagram style - 1:1 ratio) -->
                <div class="relative aspect-square bg-neutral-100 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1493976040374-85c877967a1e?w=800&q=80" alt="Post" class="w-full h-full object-cover opacity-70 grayscale hover:grayscale-0 hover:opacity-100 transition-all duration-300">
                </div>

                <!-- Post Actions (Instagram style - left aligned) -->
                <div class="flex items-center justify-between px-4 py-3">
                    <div class="flex items-center gap-2">
                        <button class="tap-target p-2 text-neutral-500 hover:text-brand-600 transition" aria-label="Beğen">
                            <svg viewBox="0 0 24 24" class="size-4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" /></svg>
                        </button>
                        <button class="tap-target p-2 text-neutral-500 hover:text-ink transition" aria-label="Yorumlar">
                            <svg viewBox="0 0 24 24" class="size-4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 11.5a8.38 8.38 0 0 1-.993 8.382c-.7.366-1.458.54-2.165.54-.796 0-1.548-.243-2.16-.773-.243-.243-.462-.64-.462-1.184V6.283c0-.308.162-.712.524-.964.216-.153.49-.227.767-.227.795 0 1.51.486 2.154.97.361.272.495.729.405 1.155-.077.353-.247.64-.484.863zM9 18a.6.6 0 0 0 0 1.2h.012zm10.628 1.2a.6.6 0 0 0 0-1.2h-.012zM9 16h.012zm10.628 0h-.012z" /></svg>
                        </button>
                        <button class="tap-target p-2 text-neutral-500 hover:text-ink transition" aria-label="Paylaş">
                            <svg viewBox="0 0 24 24" class="size-4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="18" cy="18" r="3" /><circle cx="6" cy="6" r="3" /><line x1="18" y1="6" x2="6" y2="18" /></svg>
                        </button>
                    </div>
                    <button class="tap-target p-2 text-neutral-500 hover:text-ink transition" aria-label="Kaydet">
                        <svg viewBox="0 0 24 24" class="size-4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" /></svg>
                    </button>
                </div>

                <!-- Engagement & Caption -->
                <div class="px-4 py-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-ink">selin_ankara</span>
                        <span class="text-xs text-ink-muted">342 beğeni</span>
                    </div>
                    <p class="text-xs text-ink mt-2 leading-relaxed">
                        <span class="font-semibold text-ink">selin_ankara</span> Yeni bir kitapla başladım. Bilginin tattığı amaçsız bir zevk var bu.
                    </p>
                    <p class="text-[0.625rem] text-ink-muted mt-1">1 gün önce</p>
                </div>
            </article>

        </div>

        <div data-feed-sentinel class="feed-sentinel grid min-h-8 place-items-center py-6 sm:py-8 lg:py-10" aria-hidden="true"></div>

        <div data-feed-status class="min-h-6 text-center text-xs text-ink-muted" role="status" aria-live="polite"></div>

        <div data-feed-error class="hidden text-center" role="alert">
            <x-ui.button type="button" variant="secondary" size="sm" data-feed-retry>Tekrar dene</x-ui.button>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Süper Beğen butonları için Alpine.js benzeri basit entegrasyon
            const superLikeButtons = document.querySelectorAll('[data-super-like]');

            superLikeButtons.forEach(btn => {
                btn.addEventListener('click', async function (e) {
                    const userId = this.dataset.userId;
                    const remainingEl = this.querySelector('[data-super-like-remaining]');

                    try {
                        const response = await fetch(`/super-like/${userId}`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });

                        const data = await response.json();

                        if (data.success) {
                            // Animasyon
                            this.classList.add('text-brand-600', 'scale-110');
                            setTimeout(() => this.classList.remove('scale-110'), 200);

                            // Kalan hakkı güncelle
                            if (remainingEl) remainingEl.textContent = data.remaining;

                            // Tüm süper beğen butonlarını güncelle
                            document.querySelectorAll('[data-super-like-remaining]').forEach(el => {
                                el.textContent = data.remaining;
                            });

                            // Başarı mesajı göster
                            const toast = document.createElement('div');
                            toast.className = 'fixed bottom-5 right-5 bg-brand-600 text-white px-4 py-2 rounded-xl shadow-lg z-50 animate-fade-up';
                            toast.textContent = data.message;
                            document.body.appendChild(toast);
                            setTimeout(() => toast.remove(), 3000);
                        } else {
                            alert(data.error || 'Bir hata oluştu.');
                        }
                    } catch (error) {
                        console.error('Süper beğen hatası:', error);
                        alert('Bir hata oluştu.');
                    }
                });
            });
        });
    </script>
    @endpush
</x-layouts.app>
                            <svg viewBox="0 0 24 24" class="size-4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 11.5a8.38 8.38 0 0 1-.993 8.382c-.7.366-1.458.54-2.165.54-.796 0-1.548-.243-2.16-.773-.243-.243-.462-.64-.462-1.184V6.283c0-.308.162-.712.524-.964.216-.153.49-.227.767-.227.795 0 1.51.486 2.154.97.361.272.495.729.405 1.155-.077.353-.247.64-.484.863zM9 18a.6.6 0 0 0 0 1.2h.012zm10.628 1.2a.6.6 0 0 0 0-1.2h-.012zM9 16h.012zm10.628 0h-.012z" /></svg>
                        </button>
                        <button class="tap-target p-2 text-neutral-500 hover:text-ink transition" aria-label="Paylaş">
                            <svg viewBox="0 0 24 24" class="size-4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="18" cy="18" r="3" /><circle cx="6" cy="6" r="3" /><line x1="18" y1="6" x2="6" y2="18" /></svg>
                        </button>
                    </div>
                    <button class="tap-target p-2 text-neutral-500 hover:text-ink transition" aria-label="Kaydet">
                        <svg viewBox="0 0 24 24" class="size-4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" /></svg>
                    </button>
                </div>

                <!-- Engagement & Caption -->
                <div class="px-4 py-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-ink">deniz_izmir</span>
                        <span class="text-xs text-ink-muted">1.204 beğeni</span>
                    </div>
                    <p class="text-xs text-ink mt-2 leading-relaxed">
                        <span class="font-semibold text-ink">deniz_izmir</span> İzmir'in kıyısında uzun bir yürüyüş. Deniz kokusu her şeyi değiştiriyor.
                    </p>
                    <p class="text-[0.625rem] text-ink-muted mt-1">5 saat önce</p>
                </div>
            </article>