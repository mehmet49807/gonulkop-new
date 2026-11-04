<x-layouts.app title="Ayarlar · Gönülkop" description="Bildirim, gizlilik ve hesap güvenlik ayarlarınız." show-navigation wide>
    @php
        $setting = fn (string $key, mixed $default = false): mixed => data_get($settings, $key, $default);
        $toggle = fn (string $key, bool $default = true): bool => old($key) !== null
            ? old($key) === '1'
            : (bool) $setting($key, $default);
        $settingsUpdateUrl = Route::has('settings.update') ? route('settings.update') : '#';
        $passwordUpdateUrl = Route::has('settings.password') ? route('settings.password') : '#';
        $destroyUrl = Route::has('settings.destroy') ? route('settings.destroy') : '#';
    @endphp

    <x-slot:header>
        <div class="flex items-center justify-between gap-4 px-4 pt-4 sm:px-5 sm:pt-5">
            <div>
                <p class="text-xs font-semibold tracking-[0.16em] text-brand-600 uppercase">Hesap Merkezi</p>
                <h1 class="mt-1 text-lg font-bold tracking-tight text-ink">Ayarlar</h1>
                <p class="mt-1 text-sm text-ink-muted">Profil tercihlerinizi, bildirimlerinizi ve hesap güvenliğinizi yönetin.</p>
            </div>
        </div>
    </x-slot:header>

    <main class="bg-white px-4 py-6 sm:px-6 sm:py-8">
        @if (session('status'))
            <div class="mx-auto max-w-2xl mb-6 flex items-start gap-3 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-900" role="status">
                <svg viewBox="0 0 24 24" class="mt-0.5 size-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6" /></svg>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        @if (isset($errors) && $errors->any())
            <div class="mx-auto max-w-2xl mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-900" role="alert">
                <p class="font-semibold">Ayarlar kaydedilemedi.</p>
                <ul class="mt-1 list-disc space-y-0.5 ps-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- Bildirim Ayarları -->
        <section class="overflow-hidden rounded-lg border border-line bg-white p-5 shadow-sm mb-6">
            <div class="flex items-center gap-3 mb-6">
                <span class="grid size-9 shrink-0 place-items-center rounded-xl bg-primary-50 text-primary-600">
                    <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                </span>
                <div>
                    <h2 class="text-lg font-bold text-ink">Bildirimler</h2>
                    <p class="text-sm text-ink-muted">Bildirim tercihlerinizi yönetin.</p>
                </div>
            </div>

            <form method="POST" action="{{ $settingsUpdateUrl }}" class="space-y-4">
                @csrf
                @method('PATCH')

                <div class="space-y-4">
                    <x-ui.toggle
                        name="email_notifications"
                        label="E-posta bildirimleri"
                        description="E-posta üzerinden bildirim almayı açın veya kapatın."
                        :checked="$toggle('email_notifications')"
                    />
                    <x-ui.toggle
                        name="push_notifications"
                        description="Anlık bildirimleri etkinleştirin veya devre dışı bırakın."
                        :checked="$toggle('push_notifications')"
                    />
                    <x-ui.toggle
                        name="new_match_notifications"
                        description="Yeni eşleşme olduğunda size bildirim gönder."
                        :checked="$toggle('new_match_notifications')"
                    />
                    <x-ui.toggle
                        name="message_notifications"
                        description="Yeni mesaj aldığınızda bildirim alın."
                        :checked="$toggle('message_notifications')"
                    />
                </div>

                <div class="mt-8 flex justify-end">
                    <x-ui.button type="submit">Değişiklikleri kaydet</x-ui.button>
                </div>
            </form>
        </section>
        <!-- Gizlilik Ayarları -->
        <section class="overflow-hidden rounded-lg border border-line bg-white p-5 shadow-sm mb-6">
            <div class="flex items-center gap-3 mb-6">
                <span class="grid size-9 shrink-0 place-items-center rounded-xl bg-secondary-50 text-secondary-600">
                    <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4zm8 0v4.6c0 1.12-.91 2.024-2.081 2.157a43.324 43.324 0 00-2.786.56c-.526.235-.978.57-1.345.972-.399.44-.596.973-.526 1.49l.36 2.624c.042.293.254.535.536.597l2.624.36c.517.07 1.05.226 1.49.526.402.367.737.82.972 1.345.126 1.17.533 2.081.533 3.172v2.8c0 .554-.45 1-1 1H6a1 1 0 01-1-1v-2.8c0-1.091.407-2.002 1.164-2.778.132-.134.297-.297.52-.436l1.235-.782c.358-.227.765-.394 1.17-.497a43 43 0 012.786-.56c.367-.16.72-.396 1.044-.655.343-.275.614-.622.76-1.015l.36-2.624c.07-.497-.127-1.03-.525-1.47-.367-.402-.82-.737-1.345-.972a43.324 43.324 0 00-2.786-.56c-1.17-.134-2.081-.533-3.172-.533h-2.8c-.554 0-1-.45-1-1v0c0-1.091.407-2.002 1.164-2.778.132-.134.297-.297.52-.436l1.235-.782c.358-.227.765-.394 1.17-.497a43 43 0 012.786-.56c.367-.16.72-.396 1.044-.655.343-.275.614-.622.76-1.015l.36-2.624c.07-.497-.127-1.03-.525-1.47-.367-.402-.82-.737-1.345-.972a43.324 43.324 0 00-2.786-.56c-1.17-.134-2.081-.533-3.172-.533h-2.8A1 1 0 002 1.8v0c0 1.091-.407 2.002-1.164 2.778-.132.134-.297.297-.52.436L.305 4.06c-.358.227-.765.394-1.17.497a43 43 0 01-2.786.56c-.367.16-.72.396-1.044.655-.343.275-.614.622-.76 1.015l-.36 2.624c-.07.497.127 1.03.525 1.47.367.402.82.737 1.345.972a43.324 43.324 0 002.786.56c1.17.134 2.081.533 3.172.533h2.8c.554 0 1 .45 1 1v0c0-1.091-.407-2.002-1.164-2.778-.132-.134-.297-.297-.52-.436l-1.235.782c-.358.227-.765.394-1.17.497a43 43 0 01-2.786.56c-.367.16-.72.396-1.044.655-.343.275-.614.622-.76 1.015l-.36 2.624c-.07.497.127 1.03.525 1.47.367.402.82.737 1.345.972a43.324 43.324 0 002.786.56c1.17.134 2.081.533 3.172.533h2.8c.554 0 1 .45 1 1v0c0-1.091-.407-2.002-1.164-2.778-.132-.134-.297-.297-.52-.436l-1.235.782c-.358.227-.765.394-1.17.497a43 43 0 01-2.786.56c-.367.16-.72.396-1.044.655-.343.275-.614.622-.76 1.015l-.36 2.624c-.07.497.127 1.03.525 1.47.367.402.82.737 1.345.972a43.324 43.324 0 002.786.56c1.17.134 2.081.533 3.172.533h2.8c.554 0 1 .45 1 1z" /></svg>
                </span>
                <div>
                    <h2 class="text-lg font-bold text-ink">Gizlilik</h2>
                    <p class="text-sm text-ink-muted">Profilinizin görünürlüğünü ve gizlilik tercihlerinizi yönetin.</p>
                </div>
            </div>

            <form method="POST" action="{{ $settingsUpdateUrl }}" class="space-y-4">
                @csrf
                @method('PATCH')

                <div class="space-y-4">
                    <div class="group flex cursor-pointer items-center justify-between gap-5 rounded-xl border border-line/80 bg-[#fffaf7] p-4 transition hover:border-primary-200 hover:bg-primary-50/40">
                        <span class="min-w-0">
                            <span class="block text-sm font-bold text-ink">Profil görünürlüğü</span>
                            <span class="mt-1 block text-sm leading-6 text-muted">Kimlerin profilinizi görebileceğini seçin.</span>
                        </span>
                        <select name="profile_visibility" class="block w-full rounded-lg border border-line bg-white px-3 py-2 text-sm text-ink shadow-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none">
                            <option value="public" {{ $setting('profile_visibility') === 'public' ? 'selected' : '' }}>Herkes</option>
                            <option value="members" {{ $setting('profile_visibility') === 'members' ? 'selected' : '' }}>Sadece üyeler</option>
                            <option value="private" {{ $setting('profile_visibility') === 'private' ? 'selected' : '' }}>Özel</option>
                        </select>
                    </div>

                    <x-ui.toggle
                        name="show_online"
                        label="Çevrimiçi durumu göster"
                        description="Diğer üyelerin sizi çevrimiçi olarak görebilmesi için."
                        :checked="$toggle('show_online')"
                    />
                    <x-ui.toggle
                        name="show_location"
                        label="Konumu göster"
                        description="Diğer üyelerin şehrinizi görebilmesi için."
                        :checked="$toggle('show_location')"
                    />
                </div>

                <div class="mt-8 flex justify-end">
                    <x-ui.button type="submit">Değişiklikleri kaydet</x-ui.button>
                </div>
            </form>
        </section>
        <!-- Şifre Değiştirme -->
        <section class="overflow-hidden rounded-lg border border-line bg-white p-5 shadow-sm mb-6">
            <div class="flex items-center gap-3 mb-6">
                <span class="grid size-9 shrink-0 place-items-center rounded-xl bg-accent-50 text-accent-600">
                    <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0110 0v4"></path></svg>
                </span>
                <div>
                    <h2 class="text-lg font-bold text-ink">Şifre Değiştir</h2>
                    <p class="text-sm text-ink-muted">Hesap şifrenizi güncelleyin.</p>
                </div>
            </div>

            <form method="POST" action="{{ $passwordUpdateUrl }}" class="space-y-4">
                @csrf

                <div class="space-y-4">
                    <x-ui.form-field name="current_password" label="Mevcut şifre" required>
                        <input id="current_password" name="current_password" type="password" class="form-control" autocomplete="current-password" required>
                    </x-ui.form-field>

                    <x-ui.form-field name="password" label="Yeni şifre" hint="En az 8 karakter" required>
                        <input id="password" name="password" type="password" class="form-control" autocomplete="new-password" minlength="8" required>
                    </x-ui.form-field>

                    <x-ui.form-field name="password_confirmation" label="Yeni şifre tekrar" required>
                        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password" minlength="8" required>
                    </x-ui.form-field>
                </div>

                <div class="mt-8 flex justify-end">
                    <x-ui.button type="submit">Şifreyi değiştir</x-ui.button>
                </div>
            </form>
        </section>

        <!-- Hesap Silme -->
        <section class="overflow-hidden rounded-lg border border-line bg-white p-5 shadow-sm">
            <div class="flex items-center gap-3 mb-6">
                <span class="grid size-9 shrink-0 place-items-center rounded-xl bg-red-50 text-red-600">
                    <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                </span>
                <div>
                    <h2 class="text-lg font-bold text-ink">Hesabı Sil</h2>
                    <p class="text-sm text-ink-muted">Hesabınızı kalıcı olarak silin.</p>
                </div>
            </div>

            <div class="bg-red-50/50 border border-red-100/50 rounded-lg p-4">
                <h3 class="text-sm font-bold text-red-900">Tehlikeli işlem</h3>
                <p class="mt-1 text-sm text-red-800/80">Hesabınız, mesajlarınız ve profil gönderileriniz kalıcı olarak silinir. Bu işlem geri alınamaz.</p>
            </div>

            <form method="POST" action="{{ $destroyUrl }}" data-confirm="Hesabınız kalıcı olarak silinecek. Bu işlemi onaylıyor musunuz?" class="mt-6">
                @csrf
                @method('DELETE')

                <div class="space-y-4">
                    <x-ui.form-field name="current_password" label="Mevcut şifre" hint="Silme işlemini doğrulamak için şifrenizi girin." required>
                        <input id="current_password" name="current_password" type="password" class="form-control" autocomplete="current-password" required>
                    </x-ui.form-field>
                </div>

                <div class="mt-6 flex justify-end">
                    <x-ui.button type="submit" variant="danger">Hesabımı kalıcı olarak sil</x-ui.button>
                </div>
            </form>
        </section>
    </main>
</x-layouts.app>