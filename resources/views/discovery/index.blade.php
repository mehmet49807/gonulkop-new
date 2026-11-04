<x-layouts.app title="Keşfet" description="Yeni kişileri keşfedin ve bağlantı kurun." wide>
    <x-slot:header>
        <div class="border-t border-line/60 bg-canvas/70 px-4 py-4 sm:px-5">
            <div class="flex items-end justify-between gap-4">
                <div>
                    <p class="text-xs font-semibold tracking-[0.16em] text-brand-600 uppercase">Yeni eşleşmeler</p>
                    <h1 class="mt-1 text-xl font-semibold tracking-tight text-ink">Keşfet</h1>
                </div>
                <span class="hidden text-xs text-muted sm:inline">Kartları kaydırarak inceleyin</span>
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

    <section class="bg-canvas/45 px-3 py-4 sm:px-5 sm:py-5" aria-labelledby="discovery-filters-title">
        <h2 id="discovery-filters-title" class="sr-only">Keşfet filtreleri</h2>
        <form method="GET" action="{{ route('discover.index') }}" class="surface-card grid gap-3 p-3 sm:grid-cols-[minmax(0,1fr)_minmax(0,1fr)_auto] sm:items-end">
            <x-ui.form-field name="city" label="Şehir">
                <select id="city" name="city" class="form-control">
                    <option value="">Tüm şehirler</option>
                    @foreach (($cities ?? []) as $city)
                        @php
                            $cityValue = is_string($city) || is_numeric($city) ? (string) $city : (data_get($city, 'value') ?: data_get($city, 'name'));
                            $cityName = data_get($city, 'name') ?: $cityValue;
                        @endphp
                        <option value="{{ $cityValue }}" @selected((string) $selectedCity === (string) $cityValue)>{{ $cityName }}</option>
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
                    <x-ui.button :href="route('discover.index')" variant="ghost" class="flex-1 sm:flex-none">Temizle</x-ui.button>
                @endif
            </div>
        </form>
    </section>

    <section class="bg-canvas/45 px-3 pb-6 sm:px-5" aria-labelledby="discovery-results-title">
        <div class="mb-3 flex items-center justify-between gap-3 px-1">
            <h2 id="discovery-results-title" class="text-sm font-semibold text-ink">Senin için</h2>
            <span class="text-xs text-muted">{{ count($users ?? []) }} kişi</span>
        </div>

        @if (count($users ?? []) > 0)
            <div class="no-scrollbar -mx-3 flex snap-x snap-mandatory gap-4 overflow-x-auto px-3 pb-2 sm:-mx-5 sm:px-5 lg:mx-0 lg:grid lg:grid-cols-2 lg:overflow-visible lg:px-0">
                @foreach (($users ?? []) as $user)
                    <div class="w-[86vw] max-w-[22rem] shrink-0 snap-center sm:w-[24rem] lg:w-auto lg:max-w-none">
                        <x-discovery.user-card :user="$user" />
                    </div>
                @endforeach
            </div>
        @else
            <div class="surface-card overflow-hidden">
                <x-ui.empty-state
                    title="Şu anda eşleşme bulunamadı"
                    description="Filtreleri değiştirerek daha fazla kişiyi görebilirsin."
                    icon="message"
                >
                    <x-ui.button :href="route('discover.index')" variant="secondary" size="sm">Filtreleri temizle</x-ui.button>
                </x-ui.empty-state>
            </div>
        @endif
    </section>
</x-layouts.app>
