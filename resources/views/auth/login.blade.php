<x-layouts.auth title="Giriş Yap" description="Gönül Köprüsü hesabınıza giriş yapın.">
    <section aria-labelledby="login-title" class="animate-fade-up">
        <!-- Brand Header -->
        <div class="mb-10 text-center">
            <x-brand-logo size="lg" />
        </div>

        <div class="mb-8">
            <p class="text-xs font-semibold tracking-[0.16em] text-primary-600 uppercase">Tekrar hoş geldin</p>
            <h1 id="login-title" class="mt-2 text-3xl font-semibold tracking-tight text-ink">Giriş yap</h1>
            <p class="mt-3 text-sm leading-6 text-ink-muted">Tanışmalarına kaldığın yerden devam et.</p>
        </div>

        <form method="POST" action="{{ route('login.store') }}" class="space-y-5">
            @csrf

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
                    autofocus
                >
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
                    placeholder="Şifren"
                    autocomplete="current-password"
                    required
                >
            </x-ui.form-field>

            <div class="flex items-center justify-between">
                <label class="flex min-h-11 cursor-pointer items-center gap-3 text-sm text-ink-muted">
                    <input
                        name="remember"
                        type="checkbox"
                        value="1"
                        @checked(old('remember'))
                        class="size-5 rounded border-line text-primary-600 focus:ring-primary-500"
                    >
                    <span>Beni hatırla</span>
                </label>

                <a href="#" class="text-sm font-medium text-primary-600 hover:underline underline-offset-2">
                    Şifremi unuttum
                </a>
            </div>

            <x-ui.button type="submit" size="lg" class="w-full btn-primary btn-block">
                Giriş yap
                <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
            </x-ui.button>
        </form>

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

        <p class="mt-7 text-center text-sm text-ink-muted">
            Henüz hesabın yok mu?
            <a href="{{ route('register') }}" class="font-semibold text-primary-700 underline-offset-4 hover:underline">Kayıt ol</a>
        </p>

    </section>
</x-layouts.auth>
