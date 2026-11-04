<x-layouts.app title="Profil · Gönülkop" description="Profilinizi ve paylaşımlarınızı keşfedin." show-navigation wide>
    @php
        $profileId = data_get($profile, 'id');
        $viewerId = auth()->id();
        $isOwner = (bool) (data_get($profile, 'is_owner') ?? ($profileId && $viewerId && (string) $profileId === (string) $viewerId));
        $profileData = $profile instanceof Illuminate\Database\Eloquent\Model ? $profile->getAttributes() : $profile;
        $profileName = data_get($profileData, 'name') ?: 'Gönülkop üyesi';
        $username = data_get($profileData, 'username');
        $profileImage = data_get($profileData, 'avatar_url') ?: data_get($profileData, 'profile_photo_path') ?: data_get($profileData, 'avatar_path') ?: data_get($profileData, 'profile_image') ?: data_get($profileData, 'image_path');
        $profileCity = data_get($profileData, 'city');
        $profileBio = data_get($profileData, 'bio') ?: data_get($profileData, 'about');
        $birthDate = data_get($profileData, 'birth_date') ?: data_get($profileData, 'date_of_birth');
        $age = data_get($profileData, 'age');

        if (! $age && $birthDate) {
            try {
                $age = Illuminate\Support\Carbon::parse($birthDate)->age;
            } catch (Throwable) {
                $age = null;
            }
        }

        if ($profileImage && ! Illuminate\Support\Str::startsWith($profileImage, ['http://', 'https://', '/', 'data:', 'blob:'])) {
            $profileImage = asset('storage/'.$profileImage);
        }

        $postCount = data_get($profile, 'post_count') ?? count(data_get($profile, 'posts') ?? []);
        $followersCount = data_get($profile, 'followers_count') ?? 0;
        $followingCount = data_get($profile, 'following_count') ?? 0;
    @endphp

    <x-slot:header>
        <div class="flex items-center justify-between gap-4 px-4 pt-4 sm:px-5 sm:pt-5">
            <div>
                <p class="text-xs font-semibold tracking-[0.16em] text-brand-600 uppercase">{{ $isOwner ? 'Hesabım' : 'Profil' }}</p>
                <h1 class="mt-1 text-lg font-semibold tracking-tight text-ink">{{ $isOwner ? 'Profili Düzenle' : $profileName }}</h1>
            </div>
            @if ($isOwner)
                <a href="{{ route('settings.edit') }}" class="tap-target grid size-9 place-items-center rounded-lg text-ink transition hover:bg-brand-50 hover:text-brand-600" aria-label="Ayarlar">
                    <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.7 1.7 0 0 0 .34 1.88l.06.06-2.83 2.83-.06-.06a1.7 1.7 0 0 0-1.88-.34 1.7 1.7 0 0 0-1.03 1.56V21h-4v-.09a1.7 1.7 0 0 0-1.88.34l-.06.06-2.83-2.83.06-.06A1.7 1.7 0 0 0 4.57 15 1.7 1.7 0 0 0 3 14H3v-4h.09a1.7 1.7 0 0 0 .34-1.88L4.2 7l2.83-2.83.06.06A1.7 1.7 0 0 0 9 4.57 1.7 1.7 0 0 0 10 3h4v.09a1.7 1.7 0 0 0 1.06 1.51 1.7 1.7 0 0 0 1.88-.34L17 4.2 19.83 7l-.06.06a1.7 1.7 0 0 0-.34 1.88A1.7 1.7 0 0 0 21 10h.09v4H21a1.7 1.7 0 0 0-1.6 1Z"></path></svg>
                </a>
            @endif
        </div>
    </x-slot:header>

    <main class="bg-white px-4 py-6 sm:px-6 sm:py-8 lg:px-8">
        <section class="mt-6 overflow-hidden rounded-lg border border-line bg-white p-5 shadow-sm">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:gap-6">
                <div class="relative">
                    <x-ui.avatar :src="$profileImage" :name="$profileName" size="xl" />
                    @if ($isOwner)
                        <button type="button" class="absolute -right-1 -bottom-1 size-8 rounded-full bg-brand-600 text-white shadow-sm flex items-center justify-center transition hover:bg-brand-700" aria-label="Profil fotoğrafını değiştir">
                            <svg viewBox="0 0 24 24" class="size-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 5v14M5 12h14"></path></svg>
                        </button>
                    @endif
                </div>

                <div class="min-w-0 flex-1">
                    <div class="flex items-center gap-2">
                        <h2 id="profile-summary-title" class="text-lg font-bold text-ink">{{ $profileName }}</h2>
                        @if ($username)
                            <span class="text-xs text-ink-muted">@{{ $username }}</span>
                        @endif
                        @if ($isOwner)
                            <span class="rounded-full bg-brand-100 px-2.5 py-0.5 text-[0.65rem] font-bold text-brand-800">Siz</span>
                        @endif
                    </div>
                    @if ($profileBio)
                        <p class="mt-2 text-sm text-ink-muted line-clamp-2">{{ $profileBio }}</p>
                    @endif
                    <div class="mt-4 flex items-center gap-1 text-xs text-ink-muted">
                        @if ($age)
                            <span>{{ $age }} yaş</span>
                        @endif
                        @if ($profileCity)
                            <span aria-hidden="true">·</span>
                            <span>{{ $profileCity }}</span>
                        @endif
                    </div>
                </div>

                @if ($isOwner)
                    <div class="flex flex-col items-end gap-2 sm:flex-row sm:items-center sm:justify-end">
                        <button class="w-full sm:w-auto inline-flex min-h-10 items-center justify-center rounded-full bg-white border border-line px-4 text-sm font-semibold text-ink shadow-sm transition hover:bg-neutral-50">
                            Düzenle
                        </button>
                        <a href="{{ route('settings.edit') }}" class="inline-flex min-h-10 items-center justify-center rounded-full bg-brand-600 px-4 text-sm font-semibold text-white shadow-brand hover:bg-brand-700 transition">
                            Ayarlar
                        </a>
                    </div>
                @else
                    <button class="w-full inline-flex min-h-10 items-center justify-center rounded-full bg-brand-600 px-4 text-sm font-semibold text-white shadow-brand hover:bg-brand-700 transition">
                        Takip Et
                    </button>
                @endif
            </div>

            <div class="mt-6 flex gap-x-12 sm:gap-x-16">
                <div class="flex-1 text-center">
                    <p class="text-xs font-bold text-ink-muted uppercase tracking-[0.12em]">Gönderiler</p>
                    <p class="text-lg font-bold text-ink">{{ $postCount }}</p>
                </div>
                <div class="flex-1 text-center">
                    <p class="text-xs font-bold text-ink-muted uppercase tracking-[0.12em]">Takipçiler</p>
                    <p class="text-lg font-bold text-ink">{{ $followersCount }}</p>
                </div>
                <div class="flex-1 text-center">
                    <p class="text-xs font-bold text-ink-muted uppercase tracking-[0.12em]">Takip Edilen</p>
                    <p class="text-lg font-bold text-ink">{{ $followingCount }}</p>
                </div>
            </div>
        </section>
        @if ($isOwner || (auth()->check() && auth()->user()->isAdmin()))
        <section class="mt-6 overflow-hidden rounded-lg border border-line bg-white p-5 shadow-sm">
            <h2 class="text-sm font-semibold text-ink-muted uppercase tracking-[0.12em] mb-5">Özel Bilgiler</h2>
            <div class="space-y-4">
                <div class="flex items-center gap-4 px-4 py-3 bg-neutral-50 rounded-lg border border-line/60">
                    <span class="text-sm font-medium text-ink-muted">E-posta</span>
                    <p class="ml-auto text-sm font-medium text-ink">{{ data_get($profileData, 'email') ?: '-' }}</p>
                </div>
                <div class="flex items-center gap-4 px-4 py-3 bg-neutral-50 rounded-lg border border-line/60">
                    <span class="text-sm font-medium text-ink-muted">Tam Ad</span>
                    <p class="ml-auto text-sm font-medium text-ink">{{ data_get($profileData, 'full_name') ?: '-' }}</p>
                </div>
                <div class="flex items-center gap-4 px-4 py-3 bg-neutral-50 rounded-lg border border-line/60">
                    <span class="text-sm font-medium text-ink-muted">Telefon</span>
                    <p class="ml-auto text-sm font-medium text-ink">{{ data_get($profileData, 'phone') ?: '-' }}</p>
                </div>
            </div>
        </section>
@endif

@php
            $profilePosts = is_object($posts) && method_exists($posts, 'items')
                ? $posts->items()
                : ($posts instanceof Illuminate\Support\Collection ? $posts->all() : ($posts ?? []));
        @endphp

        <section class="mt-8" aria-labelledby="profile-posts-title">
            <div class="mb-4 flex items-center justify-between gap-3 px-1">
                <h2 id="profile-posts-title" class="text-base font-bold text-ink">Gönderiler</h2>
                <span class="text-xs font-medium text-ink-muted">{{ count($profilePosts) }}</span>
            </div>

            <div class="profile-grid">
                @forelse ($profilePosts as $post)
                    <div class="profile-grid-item group relative overflow-hidden cursor-pointer">
                        <img src="{{ data_get($post, 'image_path') ? asset('storage/'.data_get($post, 'image_path')) : '' }}" alt="Gönderi" class="size-full object-cover group-hover:scale-105 transition-transform duration-200">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-center justify-center">
                            <svg viewBox="0 0 24 24" class="size-6 text-white" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 flex flex-col items-center justify-center py-12 text-center">
                        <x-ui.empty-state
                            title="Henüz gönderi yok"
                            description="Bu profilin yayımlanmış gönderileri burada görünecek."
                            icon="message"
                        />
                    </div>
                @endforelse
            </div>
        </section>
    </main>
</x-layouts.app>