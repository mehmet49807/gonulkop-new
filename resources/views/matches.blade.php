<x-layouts.app title="Eşleşmeler · Gönülkop" description="Kartları kaydırarak yeni kişileri keşfedin." wide>
    <x-slot:header>
        <div class="border-t border-line/60 bg-canvas/70 px-4 py-4 sm:px-5">
            <div class="flex items-end justify-between gap-4">
                <div>
                    <p class="text-xs font-semibold tracking-[0.16em] text-brand-600 uppercase">Keşfet</p>
                    <h1 class="mt-1 text-xl font-semibold tracking-tight text-ink">Eşleşmeler</h1>
                </div>
                <span class="hidden text-xs text-muted sm:inline">Saya beğenin, sola geçin</span>
            </div>
        </div>
    </x-slot:header>

    @php
        $selectedCity = data_get($filters, 'city', request('city', ''));
        $selectedAge = data_get($filters, 'age', request('age', 'all'));
        $ageOptions = [
            'all' => 'Tüm yaşlar',
            '18-24' => '18-24',
            '25-34' => '25-34',
            '35-44' => '35-44',
            '45+' => '45+',
        ];
    @endphp

    <!-- Filtreler -->
    <section class="bg-canvas/45 px-3 py-4 sm:px-5 sm:py-5 sticky top-0 z-20">
        <form method="GET" action="{{ route('matches.index') }}" class="surface-card grid gap-3 p-3 sm:grid-cols-[minmax(0,1fr)_minmax(0,1fr)_auto] sm:items-end">
            <x-ui.form-field name="city" label="Şehir">
                <select id="city" name="city" class="form-control">
                    <option value="">Tüm şehirler</option>
                    @php
                        $cities = App\Models\User::query()
                            ->whereNotNull('city')
                            ->distinct()
                            ->orderBy('city')
                            ->pluck('city');
                    @endphp
                    @foreach ($cities as $city)
                        <option value="{{ $city }}" @selected((string) $selectedCity === (string) $city)>{{ $city }}</option>
                    @endforeach
                </select>
            </x-ui.form-field>

            <x-ui.form-field name="age" label="Yaş aralığı">
                <select id="age" name="age" class="form-control">
                    @foreach ($ageOptions as $value => $label)
                        <option value="{{ $value }}" @selected((string) $selectedAge === (string) $value)>{{ $label }}</option>
                    @endforeach
                </select>
            </x-ui.form-field>

            <div class="flex gap-2">
                <x-ui.button type="submit" class="flex-1 sm:flex-none">Filtrele</x-ui.button>
                @if (filled($selectedCity) || $selectedAge !== 'all')
                    <x-ui.button :href="route('matches.index')" variant="ghost" class="flex-1 sm:flex-none">Temizle</x-ui.button>
                @endif
            </div>
        </form>
    </section>

    <section
        x-data="matchesSwipe({{ json_encode($users ?? [], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) }})"
        x-init="loadCards()"
        class="bg-canvas/45 px-3 pb-6 sm:px-5 min-h-[calc(100dvh-20rem)]"
    >
        <div class="mb-4 flex items-center justify-between gap-3 px-1">
            <h2 class="text-sm font-semibold text-ink">Senin için</h2>
            <span class="text-xs text-muted">{{ count($users ?? []) }} kişi</span>
        </div>

        @if (count($users ?? []) > 0)
            <div class="relative h-[calc(100dvh-24rem)] flex items-center justify-center px-2 sm:px-5 lg:px-0">
                <div
                    x-show="currentIndex < cards.length"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                    class="relative w-full max-w-md lg:max-w-lg"
                >
                    <template x-for="(card, index) in cards" :key="card.id">
                        <div
                            x-show="index === currentIndex"
                            x-transition
                            x-transition:enter="transition ease-out duration-500"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute inset-0 flex flex-col"
                        >
                            <x-matches.swipe-card
                                :card="json_decode(json_encode($card), true)"
                                :index="index"
                                :total="cards.length"
                            />
                        </div>
                    </template>
                </div>

                <div x-show="currentIndex < cards.length" class="absolute bottom-6 left-1/2 -translate-x-1/2 flex items-center gap-2 text-xs font-medium text-ink-muted bg-white/80 backdrop-blur px-3 py-1.5 rounded-full border border-line">
                    <span x-text="currentIndex + 1"></span>
                    <span>/</span>
                    <span x-text="cards.length"></span>
                </div>

                <div
                    x-show="currentIndex >= cards.length"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    class="flex flex-col items-center justify-center text-center p-8"
                >
                    <div class="size-20 rounded-full bg-brand-50 flex items-center justify-center mb-4">
                        <svg viewBox="0 0 24 24" class="size-10 text-brand-600" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M12 2c3.79 0 7.29 1.14 10 3v6c0 4.42-3.58 8-8 8s-8-3.58-8-8V5c2.71-1.86 6.21-3 10-3Z" />
                            <path d="M12 17a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-ink mb-1">Tüm kartları gördünüz</h3>
                    <p class="text-sm text-muted mb-6">Filtreleri değiştirerek daha fazla kişiyi keşfedebilirsiniz.</p>
                    <x-ui.button :href="route('matches.index')" variant="secondary">Filtreleri sıfırla</x-ui.button>
                </div>
            </div>

            <div x-show="currentIndex < cards.length" class="fixed bottom-6 left-1/2 -translate-x-1/2 z-40 flex gap-4 px-4 sm:px-6">
                <button
                    x-on:click="passCard"
                    class="tap-target flex-1 flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl bg-white border border-line shadow-float hover:bg-neutral-50 transition-all active:scale-95"
                    aria-label="Geç"
                >
                    <svg viewBox="0 0 24 24" class="size-5 text-neutral-500" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M15 18l-6-6 6-6" />
                    </svg>
                    <span class="text-sm font-semibold text-neutral-500">Geç</span>
                </button>

                <button
                    x-on:click="superLikeCard"
                    class="tap-target flex-1 flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl bg-yellow-400 text-neutral-900 shadow-sm hover:bg-yellow-300 transition-all active:scale-95"
                    aria-label="Süper Beğen"
                >
                    <svg viewBox="0 0 24 24" class="size-5 fill-current" fill="currentColor" aria-hidden="true">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                    </svg>
                    <span class="text-sm font-semibold text-neutral-900">Süper Beğen</span>
                </button>

                <button
                    x-on:click="likeCard"
                    class="tap-target flex-1 flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl bg-brand-600 text-white shadow-brand hover:bg-brand-700 transition-all active:scale-95"
                    aria-label="Beğen"
                >
                    <svg viewBox="0 0 24 24" class="size-5" fill="currentColor" aria-hidden="true">
                        <path d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                    </svg>
                    <span class="text-sm font-semibold">Beğen</span>
                </button>
            </div>

            <div x-show="feedback !== null" x-transition class="pointer-events-none absolute inset-0 z-50 flex items-center justify-center">
                <div
                    x-show="feedback === 'like'"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-50 rotate-12"
                    x-transition:enter-end="opacity-100 scale-100 rotate-0"
                    x-transition:leave="transition ease-in duration-200"
                    class="absolute top-1/4 left-1/2 -translate-x-1/2 text-[6rem] text-brand-600/90 select-none"
                >
                    <span>❤️</span>
                </div>
                <div
                    x-show="feedback === 'pass'"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-50 rotate-12"
                    x-transition:enter-end="opacity-100 scale-100 rotate-0"
                    x-transition:leave="transition ease-in duration-200"
                    class="absolute top-1/4 left-1/2 -translate-x-1/2 text-[6rem] text-neutral-500/90 select-none"
                >
                    <span>✕</span>
                </div>
            </div>

        @else
            <div class="surface-card overflow-hidden flex flex-col items-center justify-center text-center p-8">
                <x-ui.empty-state
                    title="Şu anda eşleşme bulunamadı"
                    description="Filtreleri değiştirerek daha fazla kişiyi görebilirsiniz."
                    icon="heart"
                >
                    <x-ui.button :href="route('matches.index')" variant="secondary" size="sm">Filtreleri temizle</x-ui.button>
                </x-ui.empty-state>
            </div>
        @endif
    </section>

    @push('scripts')
        <script>
            function matchesSwipe(cards) {
                return {
                    cards: cards,
                    currentIndex: 0,
                    feedback: null,
                    isAnimating: false,

                    loadCards() {
                        if (this.cards.length === 0) {
                            this.currentIndex = -1;
                        }
                    },

                    likeCard() {
                        if (this.isAnimating || this.currentIndex >= this.cards.length) return;
                        this.isAnimating = true;
                        this.feedback = 'like';

                        setTimeout(() => {
                            this.currentIndex++;
                            this.feedback = null;
                            this.isAnimating = false;
                        }, 400);
                    },

                    passCard() {
                        if (this.isAnimating || this.currentIndex >= this.cards.length) return;
                        this.isAnimating = true;
                        this.feedback = 'pass';

                        setTimeout(() => {
                            this.currentIndex++;
                            this.feedback = null;
                            this.isAnimating = false;
                        }, 400);
                    },

                    async superLikeCard() {
                        if (this.isAnimating || this.currentIndex >= this.cards.length) return;
                        const card = this.cards[this.currentIndex];
                        if (!card) return;

                        this.isAnimating = true;
                        this.feedback = 'superlike';

                        try {
                            const response = await fetch(`/super-like/${card.id}`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                    'Accept': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            });

                            const data = await response.json();

                            if (data.success) {
                                setTimeout(() => {
                                    this.currentIndex++;
                                    this.feedback = null;
                                    this.isAnimating = false;
                                }, 400);

                                // Başarı toast
                                const toast = document.createElement('div');
                                toast.className = 'fixed bottom-5 right-5 bg-brand-600 text-white px-4 py-2 rounded-xl shadow-lg z-50 animate-fade-up';
                                toast.textContent = data.message;
                                document.body.appendChild(toast);
                                setTimeout(() => toast.remove(), 3000);
                            } else {
                                alert(data.error || 'Bir hata oluştu.');
                                this.feedback = null;
                                this.isAnimating = false;
                            }
                        } catch (error) {
                            console.error('Süper beğen hatası:', error);
                            alert('Bir hata oluştu.');
                            this.feedback = null;
                            this.isAnimating = false;
                        }
                    },
                };
            }
        </script>
    @endpush>
</x-layouts.app>