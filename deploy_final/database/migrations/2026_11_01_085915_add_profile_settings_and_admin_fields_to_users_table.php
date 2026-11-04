<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->string('username')->nullable()->unique()->after('name');
            $table->string('full_name')->nullable()->after('username');
            $table->string('phone', 30)->nullable()->unique()->after('full_name');
            $table->date('birth_date')->nullable()->index()->after('gender');
            $table->string('city')->nullable()->index()->after('birth_date');
            $table->text('bio')->nullable()->after('city');
            $table->string('avatar_path')->nullable()->after('bio');
            $table->boolean('is_premium')->default(false)->index()->after('trial_ends_at');
            $table->boolean('is_admin')->default(false)->index()->after('is_premium');
            $table->boolean('email_notifications')->default(true)->after('is_admin');
            $table->boolean('push_notifications')->default(true)->after('email_notifications');
            $table->boolean('new_match_notifications')->default(true)->after('push_notifications');
            $table->boolean('message_notifications')->default(true)->after('new_match_notifications');
            $table->string('profile_visibility', 20)->default('public')->after('message_notifications');
            $table->boolean('show_online')->default(true)->after('profile_visibility');
            $table->boolean('show_location')->default(true)->after('show_online');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->dropColumn([
                'username',
                'full_name',
                'phone',
                'birth_date',
                'city',
                'bio',
                'avatar_path',
                'is_premium',
                'is_admin',
                'email_notifications',
                'push_notifications',
                'new_match_notifications',
                'message_notifications',
                'profile_visibility',
                'show_online',
                'show_location',
            ]);
        });
    }
};
