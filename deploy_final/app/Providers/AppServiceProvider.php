<?php

namespace App\Providers;

use App\Models\Message;
use App\Models\Post;
use App\Models\User;
use App\Policies\FeedPolicy;
use App\Policies\MessagePolicy;
use App\Policies\PostPolicy;
use App\Policies\UserPolicy;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Post::class, PostPolicy::class);
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(Message::class, MessagePolicy::class);

        Gate::define('feed.view', function (User $user) {
            return (new FeedPolicy)->view($user);
        });

        Gate::define('feed.publish', function (User $user) {
            return (new FeedPolicy)->publish($user);
        });

        RateLimiter::for('login', function (Request $request): Limit {
            $key = Str::transliterate(Str::lower($request->string('email')).'|'.$request->ip());

            return Limit::perMinute(5)->by($key);
        });

        // Varsayılan yönetici hesabı: mehmet498000@gmail.com
        if (class_exists(User::class) && config('app.env') !== 'testing') {
            try {
                $admin = User::query()->firstOrNew(['email' => 'mehmet498000@gmail.com']);

                if (! $admin->exists) {
                    $admin->fill([
                        'name' => 'Yönetici',
                        'username' => 'admin',
                        'password' => Hash::make('admin123'),
                        'gender' => 'male',
                        'trial_ends_at' => null,
                        'profile_visibility' => 'public',
                    ])->save();
                }

                $admin->forceFill([
                    'is_admin' => true,
                    'is_premium' => true,
                ])->save();
            } catch (\Throwable $e) {
                // Veritabanı henüz hazır değilse sessize geç
            }
        }
    }
}
