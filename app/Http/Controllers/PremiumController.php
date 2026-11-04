<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PremiumController extends Controller
{
    /**
     * Display the premium membership page for male members.
     */
    public function index(Request $request): View|RedirectResponse
    {
        $member = $request->user();

        // Only male members can access premium page
        if ($member->gender?->value !== 'male') {
            return redirect()->route('feed.index')
                ->with('error', 'Premium paketler yalnızca erkek üyeler için geçerlidir.');
        }

        $packages = [
            [
                'name' => 'Silver',
                'name_tr' => 'Gümüş',
                'price' => 149,
                'currency' => 'TL',
                'duration' => '1 Ay',
                'duration_days' => 30,
                'popular' => false,
                'features' => [
                    'Sınırsız mesajlaşma',
                    'Profil ziyaretçilerini gör',
                    'Gelişmiş filtreleme',
                    'Öncelikli destek',
                ],
                'badge' => null,
            ],
            [
                'name' => 'Gold',
                'name_tr' => 'Altın',
                'price' => 800,
                'currency' => 'TL',
                'duration' => '20 Gün',
                'duration_days' => 20,
                'popular' => true,
                'features' => [
                    'Sınırsız mesajlaşma',
                    'Profil ziyaretçilerini gör',
                    'Gelişmiş filtreleme',
                    'Öncelikli destek',
                    'Reklam gözükmez',
                    'Profil öne çıkar',
                ],
                'badge' => 'En Popüler',
            ],
            [
                'name' => 'Platinum',
                'name_tr' => 'Platin',
                'price' => 1000,
                'currency' => 'TL',
                'duration' => '45 Gün',
                'duration_days' => 45,
                'popular' => false,
                'features' => [
                    'Sınırsız mesajlaşma',
                    'Profil ziyaretçilerini gör',
                    'Gelişmiş filtreleme',
                    'Öncelikli destek',
                    'Reklam gözükmez',
                    'Profil öne çıkar',
                    'Kim beğendiğini gör',
                    'Gizli mod',
                ],
                'badge' => 'En Değerli',
            ],
            [
                'name' => 'Pro',
                'name_tr' => 'Pro',
                'price' => 500,
                'currency' => 'TL',
                'duration' => '10 Gün',
                'duration_days' => 10,
                'popular' => true,
                'features' => [
                    'Sınırsız mesajlaşma',
                    'Profil ziyaretçilerini gör',
                    'Gelişmiş filtreleme',
                    'Öncelikli destek',
                    'Reklam gözükmez',
                    'Profil öne çıkar',
                    'Kim beğendiğini gör',
                    'Gizli mod',
                ],
                'badge' => 'En Popüler',
            ],
        ];

        $currentMember = $member;

        return view('premium', [
            'member' => $currentMember,
            'packages' => $packages,
        ]);
    }

    /**
     * Process premium purchase (placeholder for payment integration).
     */
    public function purchase(Request $request, string $package): RedirectResponse
    {
        $member = $request->user();

        if ($member->gender?->value !== 'male') {
            return redirect()->route('feed.index')
                ->with('error', 'Premium paketler yalnızca erkek üyeler için geçerlidir.');
        }

        $validPackages = ['silver', 'gold', 'platinum', 'pro'];
        if (! in_array(strtolower($package), $validPackages)) {
            return redirect()->route('premium.index')
                ->with('error', 'Geçersiz paket seçimi.');
        }

        // Here you would integrate with a payment gateway (Iyzico, PayTR, etc.)
        // For now, we'll simulate a successful purchase

        $member->forceFill([
            'is_premium' => true,
        ])->save();

        return redirect()->route('feed.index')
            ->with('success', ucfirst($package).' paketi başarıyla aktifleştirildi!');
    }
}
