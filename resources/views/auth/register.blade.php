<x-layouts.auth title="Kayıt Ol" description="Gönül Köprüsü'nde yeni bir hesap oluşturun.">
    <section aria-labelledby="register-title">
        <div class="mb-8">
            <p class="text-xs font-semibold tracking-[0.16em] text-brand-600 uppercase">Yeni başlangıç</p>
            <h1 id="register-title" class="mt-2 text-3xl font-semibold tracking-tight text-ink">Kayıt ol</h1>
            <p class="mt-3 text-sm leading-6 text-muted">Birkaç bilgiyle profilinizi oluşturun ve keşfetmeye başlayın.</p>
        </div>

        <form method="POST" action="{{ route('register.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <x-ui.form-field
                name="name"
                label="Görünen ad"
                :error="isset($errors) ? $errors->first('name') : null"
                required
            >
                <input
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name') }}"
                    class="form-control"
                    placeholder="Adınız ve soyadınız"
                    autocomplete="name"
                    required
                    autofocus
                >
            </x-ui.form-field>

            <x-ui.form-field
                name="email"
                label="E-posta"
                :error="isset($errors) ? $errors->first('email') : null"
                required
            >
                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    class="form-control"
                    placeholder="ornek@eposta.com"
                    autocomplete="email"
                    inputmode="email"
                    required
                >
            </x-ui.form-field>

            <div class="grid gap-5 sm:grid-cols-2">
                <x-ui.form-field
                    name="gender"
                    label="Cinsiyet"
                    :error="isset($errors) ? $errors->first('gender') : null"
                    required
                >
                    <select id="gender" name="gender" class="form-control" required>
                        <option value="" selected disabled>Seçiniz</option>
                        <option value="female" @selected(old('gender') === 'female')>Kadın</option>
                        <option value="male" @selected(old('gender') === 'male')>Erkek</option>
                    </select>
                </x-ui.form-field>

                <x-ui.form-field
                    name="birth_date"
                    label="Doğum tarihi"
                    :error="isset($errors) ? $errors->first('birth_date') : null"
                    required
                >
                    <input
                        id="birth_date"
                        name="birth_date"
                        type="date"
                        value="{{ old('birth_date') }}"
                        class="form-control"
                        autocomplete="bday"
                        required
                    >
                </x-ui.form-field>
            </div>

            <x-ui.form-field
                name="city"
                label="Şehir"
                :error="isset($errors) ? $errors->first('city') : null"
            >
                <input
                    id="city"
                    name="city"
                    type="text"
                    value="{{ old('city') }}"
                    class="form-control"
                    placeholder="Örn. İstanbul"
                    autocomplete="address-level2"
                >
            </x-ui.form-field>

            <x-ui.form-field name="bio" label="Biyografi" hint="En fazla 1000 karakter">
                <textarea id="bio" name="bio" rows="3" maxlength="1000" class="form-control resize-none" placeholder="Kendinden kısaca bahset...">{{ old('bio') }}</textarea>
            </x-ui.form-field>

            <x-ui.form-field name="profile_photo" label="Profil fotoğrafı" hint="JPG, PNG veya WEBP. En fazla 2 MB.">
                <input id="profile_photo" name="profile_photo" type="file" accept="image/jpeg,image/png,image/webp" class="form-control file:mr-3 file:rounded-lg file:border-0 file:bg-brand-50 file:px-3 file:py-2 file:text-sm file:font-semibold file:text-brand-700">
            </x-ui.form-field>

            <x-ui.form-field
                name="password"
                label="Şifre"
                :error="isset($errors) ? $errors->first('password') : null"
                required
            >
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="form-control"
                    placeholder="En az 8 karakter"
                    autocomplete="new-password"
                    minlength="8"
                    required
                >
            </x-ui.form-field>

            <x-ui.form-field
                name="password_confirmation"
                label="Şifre tekrar"
                :error="isset($errors) ? $errors->first('password_confirmation') : null"
                required
            >
                <input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    class="form-control"
                    placeholder="Şifrenizi yeniden girin"
                    autocomplete="new-password"
                    minlength="8"
                    required
                >
            </x-ui.form-field>

            <!-- Divider -->
            <div class="divider my-8">
                <span class="divider-text"><span>veya</span></span>
            </div>

            <!-- Social Login Buttons -->
            <div class="grid gap-3 sm:grid-cols-2">
                <button type="button" class="w-full flex items-center justify-center gap-2.5 px-4 py-3 rounded-xl border border-line bg-white text-ink font-medium transition-all hover:bg-brand-50 hover:text-white hover:border-transparent hover:shadow-brand active:scale-95" data-social-login="google">
                    <svg class="size-5" viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/></svg>
                    <span>Google ile devam et</span>
                </button>
                <button type="button" class="w-full flex items-center justify-center gap-2.5 px-4 py-3 rounded-xl border border-line bg-white text-ink font-medium transition-all hover:bg-brand-50 hover:text-white hover:border-transparent hover:shadow-brand active:scale-95" data-social-login="apple">
                    <svg class="size-5" viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M19.5 12c0-2.121-1.279-3.879-3-4.797V6.5c0-1.355-.92-2.445-2.121-2.672C13.121 2.67 12 3.76 12 5.105c0 1.345-1.121 2.435-2.121 2.672V7.203C9.279 8.121 8 9.879 8 12c0 3.309 2.691 6 6 6s6-2.691 6-6zM12 20c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zM7.25 7a1.25 1.25 0 1 1 0 2.5 1.25 1.25 0 0 1 0-2.5z"/></svg>
                    <span>Apple ile devam et</span>
                </button>
            </div>

            <p class="text-xs leading-5 text-muted">
                Kaydolarak kullanım koşullarını ve gizlilik politikasını kabul etmiş olursunuz.
            </p>

            <x-ui.button type="submit" size="lg" class="w-full">Hesap oluştur</x-ui.button>
        </form>

        <p class="mt-7 text-center text-sm text-muted">
            Zaten hesabınız var mı?
            <a href="{{ route('login') }}" class="font-semibold text-brand-700 underline-offset-4 hover:underline">Giriş yapın</a>
        </p>
    </section>
</x-layouts.auth>
