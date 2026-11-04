<x-layouts.app title="Sohbet · Gönülkop" description="Gönülkop sohbetiniz." show-navigation wide>
    @php
        $activeUser = $activeUser ?? null;
        $messages = $messages ?? [];
        $trialExpired = $trialExpired ?? false;
        $premiumRequired = $premiumRequired ?? false;
    @endphp

    <x-slot:header>
        <div class="flex items-center justify-between gap-4 px-4 pt-4 sm:px-5 sm:pt-5">
            <div>
                <p class="text-xs font-semibold tracking-[0.16em] text-brand-600 uppercase">Sohbet</p>
                <h1 class="mt-1 text-lg font-bold tracking-tight text-ink truncate">
                    {{ data_get($activeUser, 'name') ?: 'Mesajlar' }}
                </h1>
            </div>
            @if ($premiumRequired)
                <button type="button" class="tap-target grid size-9 place-items-center rounded-lg border border-amber-200 bg-amber-50 text-amber-700 transition hover:bg-amber-100" data-premium-open aria-label="Premium seçeneklerini aç">
                    <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </button>
            @endif
        </div>
    </x-slot:header>

    <main class="bg-white px-4 py-6 sm:px-6 sm:py-8">
        <x-chat.message-thread
            :active-user="$activeUser"
            :messages="$messages"
            :trial-expired="$trialExpired"
            :premium-required="$premiumRequired"
        />
    </main>

    @push('modals')
        <x-ui.premium-dialog id="premium-dialog" />
    @endpush
</x-layouts.app>