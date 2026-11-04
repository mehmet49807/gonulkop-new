<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the member's editable profile.
     */
    public function edit(Request $request): View
    {
        $member = $request->user();

        return view('profile.edit', [
            'profile' => $this->profilePayload($member, $member),
            'posts' => $member->posts()
                ->published()
                ->with('user:id,name,gender,profile_photo_path')
                ->latest('published_at')
                ->get(),
            'isOwner' => true,
        ]);
    }

    /**
     * Update the member's profile.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $member = $request->user();
        Gate::forUser($member)->authorize('update', $member);

        $data = $request->safe()->except('profile_photo');

        if ($request->hasFile('profile_photo')) {
            $previousPhoto = $member->profile_photo_path;
            $data['profile_photo_path'] = $request->file('profile_photo')->store('profile-photos', 'public');

            if ($previousPhoto !== null && $previousPhoto !== $data['profile_photo_path']) {
                Storage::disk('public')->delete($previousPhoto);
            }
        }

        $member->fill($data);
        $member->save();

        return redirect()
            ->route('profile.index')
            ->with('status', 'Your profile was updated.');
    }

    /**
     * Display a member's public profile.
     */
    public function show(Request $request, User $user): View
    {
        $member = $request->user();
        Gate::forUser($member)->authorize('view', $user);

        $isOwner = $member->getKey() === $user->getKey();

        return view('profiles.show', [
            'profile' => $this->profilePayload($user, $member),
            'posts' => $user->posts()
                ->published()
                ->with('user:id,name,gender,profile_photo_path')
                ->latest('published_at')
                ->get(),
            'isOwner' => $isOwner,
        ]);
    }

    /**
     * Build the profile payload with explicit private-field visibility.
     *
     * @return array<string, mixed>
     */
    private function profilePayload(User $profile, User $viewer): array
    {
        $payload = [
            'id' => $profile->getKey(),
            'name' => $profile->name,
            'username' => $profile->username,
            'bio' => $profile->bio,
            'city' => $profile->show_location || $viewer->getKey() === $profile->getKey()
                ? $profile->city
                : null,
            'birth_date' => $profile->birth_date?->toDateString(),
            'age' => $profile->age,
            'gender' => $profile->gender?->value,
            'profile_photo_path' => $profile->profile_photo_path,
            'avatar_path' => $profile->profile_photo_path,
            'avatar_url' => $profile->avatar_url,
            'image_path' => $profile->profile_photo_path,
            'is_owner' => $viewer->getKey() === $profile->getKey(),
            'can_view_private' => $viewer->getKey() === $profile->getKey() || $viewer->isAdmin(),
            'is_admin' => $viewer->isAdmin(),
        ];

        if ($viewer->getKey() === $profile->getKey() || $viewer->isAdmin()) {
            $payload['email'] = $profile->email;
            $payload['full_name'] = $profile->full_name;
            $payload['phone'] = $profile->phone;
        }

        return $payload;
    }
}
