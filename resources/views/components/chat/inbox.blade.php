@props([
    'conversations' => [],
    'activeUser' => null,
    'messages' => [],
    'trialExpired' => false,
    'premiumRequired' => false,
    'emptyAction' => null,
])

@php
    $hasActiveUser = filled($activeUser) && data_get($activeUser, 'id');
    $emptyAction = $emptyAction ?? route('discover.index');
@endphp

<div
    {{ $attributes->merge(['class' => 'grid h-[calc(100dvh-12.5rem)] min-h-[32rem] overflow-hidden rounded-[1.75rem] border border-line/70 bg-white shadow-[0_18px_55px_rgba(78,35,28,0.08)] lg:grid-cols-[21rem_minmax(0,1fr)]']) }}
>
    <div class="{{ $hasActiveUser ? 'hidden lg:block' : 'block' }} min-h-0 min-w-0">
        <x-chat.conversation-list
            :conversations="$conversations"
            :empty-action="$emptyAction"
        />
    </div>

    <div class="{{ $hasActiveUser ? 'block' : 'hidden lg:flex' }} min-h-0 min-w-0">
        @if ($hasActiveUser)
            <x-chat.message-thread
                :active-user="$activeUser"
                :messages="$messages"
                :trial-expired="$trialExpired"
                :premium-required="$premiumRequired"
            />
        @else
            <div class="relative flex min-h-0 flex-1 items-center justify-center overflow-hidden bg-canvas/60 p-6">
                <div class="pointer-events-none absolute -top-20 -right-16 size-64 rounded-full bg-brand-100/50 blur-3xl" aria-hidden="true"></div>
                <div class="pointer-events-none absolute -bottom-24 -left-20 size-72 rounded-full bg-secondary-100/70 blur-3xl" aria-hidden="true"></div>

                <x-ui.empty-state
                    title="Bir sohbet seçin"
                    description="Sohbetler listesinden bir kişiye dokunarak konuşmaya başlayın."
                    icon="message"
                    class="relative"
                >
                    <x-ui.button :href="$emptyAction" variant="primary" size="sm">
                        Yeni kişi bul
                        <svg viewBox="0 0 24 24" class="size-4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </x-ui.button>
                </x-ui.empty-state>
            </div>
        @endif
    </div>
</div>
