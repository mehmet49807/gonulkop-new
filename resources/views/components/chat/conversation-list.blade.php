@props([
    'conversations' => [],
    'emptyAction' => null,
])

<div {{ $attributes->merge(['class' => 'flex h-full min-h-0 flex-col bg-white lg:border-r lg:border-line/70']) }}>
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

    <div class="scrollbar-refined min-h-0 flex-1 overflow-y-auto overscroll-contain p-2.5 sm:p-3">
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
                class="group relative mb-1.5 flex min-h-[4.75rem] items-center gap-3 overflow-hidden rounded-2xl px-3 py-3 transition duration-200 hover:bg-canvas {{ $isActive ? 'bg-brand-50 ring-1 ring-brand-100' : '' }}"
                @if ($isActive) aria-current="page" @endif
            >
                @if ($isActive)
                    <span class="absolute inset-y-3 left-0 w-1 rounded-r-full bg-brand-500" aria-hidden="true"></span>
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
            <x-ui.empty-state
                title="Henüz sohbet yok"
                description="Keşfet bölümünden biriyle tanışın, mesajlar burada görünecek."
                icon="message"
            >
                <x-ui.button :href="$emptyAction ?? route('discover.index')" variant="secondary" size="sm">Keşfetmeye başla</x-ui.button>
            </x-ui.empty-state>
        @endforelse
    </div>
</div>
