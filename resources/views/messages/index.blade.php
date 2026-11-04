<x-layouts.app title="Mesajlar · Gönülkop" description="Gönülkop mesajlarınızı ve sohbetlerinizi yönetin." show-navigation wide>
    @php
        $conversations = $conversations ?? [];
        $activeUser = $activeUser ?? null;
        $messages = $messages ?? [];
        $trialExpired = $trialExpired ?? false;
        $premiumRequired = $premiumRequired ?? false;
    @endphp

    <x-slot:header>
        <div class="flex items-center justify-between gap-4 px-4 pt-4 sm:px-5 sm:pt-5">
            <div class="min-w-0">
                <p class="text-xs font-semibold tracking-[0.16em] text-brand-600 uppercase">Bağlantılar</p>
                <h1 class="mt-1 text-lg font-bold tracking-tight text-ink">Mesajlar</h1>
                <p class="mt-1 text-sm text-ink-muted">Sevdiğin kişilerle sıcak ve samimi sohbetler kur.</p>
            </div>
            @if ($premiumRequired)
                <button type="button" class="tap-target grid size-9 place-items-center rounded-lg border border-amber-200 bg-amber-50 text-amber-700 transition hover:bg-amber-100" data-premium-open aria-label="Premium seçeneklerini aç">
                    <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </button>
            @endif
        </div>
    </x-slot:header>

    <main class="bg-white px-4 py-6 sm:px-6 sm:py-8">
        <div class="grid min-h-[calc(100dvh-14rem)] lg:grid-cols-[20rem_minmax(0,1fr)] gap-0">
            <!-- Conversation List (desktop only) -->
            <div class="hidden lg:flex min-h-0 flex-col border-r border-line/60 bg-white">
                <div class="shrink-0 border-b border-line/60 bg-white px-4 py-4 sm:px-5">
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <p class="text-[0.65rem] font-bold uppercase tracking-[0.18em] text-brand-600">Konuşmalar</p>
                            <h2 class="mt-1 text-lg font-extrabold tracking-tight text-ink">Sohbetler</h2>
                        </div>
                        <span class="grid min-w-7 place-items-center rounded-full bg-brand-50 px-2 py-1 text-[0.6875rem] font-bold text-brand-700">
                            {{ count($conversations ?? []) }}
                        </span>
                    </div>
                </div>

                <div class="min-h-0 flex-1 overflow-y-auto overscroll-contain p-2.5 sm:p-3">
                    @forelse (($conversations ?? []) as $conversation)
                        @php
                            $participant = data_get($conversation, 'user')
                                ?: data_get($conversation, 'participant')
                                ?: data_get($conversation, 'other_user')
                                ?: $conversation;
                            $participantData = $participant instanceof Illuminate\Database\Eloquent\Model ? $participant->getAttributes() : $participant;
                            $participantId = data_get($participantData, 'id') ?: data_get($conversation, 'user_id');
                            $name = data_get($participantData, 'name') ?: data_get($conversation, 'name') ?: 'Gönülkop üyesi';
                            $displayName = data_get($participantData, 'username') ?: data_get($conversation, 'username') ?: $name;
                            $image = data_get($participantData, 'avatar_url') ?: data_get($participantData, 'profile_photo_path') ?: data_get($participantData, 'avatar_path') ?: data_get($participantData, 'profile_image') ?: data_get($participantData, 'image_path');
                            $lastMessage = data_get($conversation, 'last_message') ?: data_get($conversation, 'latest_message') ?: data_get($conversation, 'message');
                            $preview = is_string($lastMessage) ? $lastMessage : (data_get($lastMessage, 'content') ?: data_get($conversation, 'preview') ?: 'Sohbeti açın');
                            $unreadCount = (int) (data_get($conversation, 'unread_count') ?: data_get($conversation, 'unread_messages_count') ?: 0);
                            $updatedAt = data_get($conversation, 'updated_at') ?: data_get($conversation, 'last_message_at') ?: data_get($conversation, 'created_at');

                            if ($image && ! Illuminate\Support\Str::startsWith($image, ['http://', 'https://', '/', 'data:', 'blob:'])) {
                                $image = asset('storage/'.$image);
                            }

                            if ($updatedAt instanceof DateTimeInterface) {
                                $updatedAt = $updatedAt->diffForHumans();
                            }

                            $href = $participantId && Route::has('messages.show') ? route('messages.show', $participantId) : '#';
                            $isActive = request()->route('user') && (string) request()->route('user') === (string) $participantId;
                        @endphp
                        <a
                            href="{{ $href }}"
                            class="group relative mb-1.5 flex min-h-[4.75rem] items-center gap-3 overflow-hidden rounded-xl px-3 py-3 transition duration-200 hover:bg-neutral-50 {{ $isActive ? 'bg-brand-50 ring-1 ring-brand-100' : '' }}"
                            @if ($isActive) aria-current="page" @endif
                        >
                            @if ($isActive)
                                <span class="absolute inset-y-3 left-0 w-1 rounded-r-xl bg-brand-500" aria-hidden="true"></span>
                            @endif

                            <span class="relative shrink-0">
                                <x-ui.avatar :src="$image" :name="$name" size="md" />
                                @if ($unreadCount > 0)
                                    <span class="absolute -top-0.5 -right-0.5 size-3 rounded-full border-2 border-white bg-brand-500" aria-hidden="true"></span>
                                @endif
                            </span>

                            <span class="min-w-0 flex-1">
                                <span class="flex items-center justify-between gap-3">
                                    <span class="truncate text-sm font-bold text-ink group-hover:text-brand-700">{{ $displayName }}</span>
                                    @if ($updatedAt)
                                        <span class="shrink-0 text-[0.6875rem] font-medium text-ink-muted">{{ $updatedAt }}</span>
                                    @endif
                                </span>
                                <span class="mt-1 flex items-center justify-between gap-3">
                                    <span class="truncate text-xs leading-5 text-ink-muted">{{ $preview }}</span>
                                    @if ($unreadCount > 0)
                                        <span class="grid min-w-5 shrink-0 place-items-center rounded-full bg-brand-600 px-1.5 py-0.5 text-[0.625rem] font-bold text-white shadow-sm">
                                            {{ $unreadCount > 99 ? '99+' : $unreadCount }}
                                        </span>
                                    @endif
                                </span>
                            </span>
                        </a>
                    @empty
                        <div class="flex flex-col items-center justify-center py-16 text-center">
                            <x-ui.empty-state
                                title="Henüz sohbet yok"
                                description="Keşfet bölümünden biriyle tanışın, mesajlar burada görünecek."
                                icon="message"
                                class="w-full"
                            >
                                <x-ui.button :href="route('discover.index')" variant="secondary" size="sm">Keşfetmeye başla</x-ui.button>
                            </x-ui.empty-state>
                        </div>
                    @endforelse
                </div>
            </div>
            <!-- Active Conversation -->
            <div class="min-h-0 min-w-0 flex flex-col">
                @if ($activeUser)
                    <x-chat.message-thread
                        :active-user="$activeUser"
                        :messages="$messages"
                        :trial-expired="$trialExpired"
                        :premium-required="$premiumRequired"
                    />
                @else
                    <div class="relative flex min-h-0 flex-1 items-center justify-center overflow-hidden bg-neutral-50/40 p-8">
                        <div class="pointer-events-none absolute -top-20 -right-16 size-64 rounded-full bg-brand-100/40 blur-3xl" aria-hidden="true"></div>
                        <div class="pointer-events-none absolute -bottom-24 -left-20 size-72 rounded-full bg-secondary-100/60 blur-3xl" aria-hidden="true"></div>

                        <div class="relative z-10 flex flex-col items-center justify-center text-center">
                            <svg viewBox="0 0 24 24" class="size-16 text-neutral-300 mb-4" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                            </svg>
                            <h3 class="text-lg font-bold text-ink mb-1">Bir sohbet seçin</h3>
                            <p class="text-sm text-ink-muted">Sohbetler listesinden bir kişiye dokunarak konuşmaya başlayın.</p>
                            <a href="{{ route('matches.index') }}" class="mt-6 inline-flex items-center gap-2 text-sm font-medium text-brand-600 hover:text-brand-700 transition" aria-label="Yeni eşleşme">
                                <svg viewBox="0 0 24 24" class="size-4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7" /></svg>
                                Yeni kişi bul
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </main>

    @push('modals')
        <x-ui.premium-dialog id="premium-dialog" />
    @endpush
</x-layouts.app>