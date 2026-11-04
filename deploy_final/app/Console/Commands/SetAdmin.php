<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class SetAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:set-admin {email} {--password=} {--name=} {--username=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bir kullanıcıyı yönetici (admin) yapar veya yeni oluşturur';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $email = $this->argument('email');

        $user = User::where('email', $email)->first();

        if ($user) {
            // Mevcut kullanıcıyı admin yap
            $user->forceFill([
                'is_admin' => true,
                'is_premium' => true,
            ])->save();

            $this->info("✅ Kullanıcı admin yapıldı: {$email}");
            $this->info("   İsim: {$user->name}");
            $this->info("   Kullanıcı adı: @{$user->username}");
        } else {
            // Yeni admin kullanıcısı oluştur
            $name = $this->option('name') ?? 'Yönetici';
            $username = $this->option('username') ?? 'admin';
            $password = $this->option('password') ?? 'admin123';

            $admin = User::create([
                'name' => $name,
                'username' => $username,
                'email' => $email,
                'password' => Hash::make($password),
                'gender' => 'male',
                'profile_visibility' => 'public',
            ]);

            $admin->forceFill([
                'is_admin' => true,
                'is_premium' => true,
            ])->save();

            $this->info("✅ Yeni admin kullanıcısı oluşturuldu: {$email}");
            $this->info("   Şifre: {$password}");
        }

        return 0;
    }
}
