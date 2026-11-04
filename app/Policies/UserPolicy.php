<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the member can view the profile.
     */
    public function view(User $member, User $profile): Response
    {
        if ($profile->profile_visibility === 'private'
            && ! $this->isOwnerOrAdmin($member, $profile)) {
            return Response::deny('This profile is private.');
        }

        return Response::allow();
    }

    /**
     * Determine whether the member can update the profile.
     */
    public function update(User $member, User $profile): Response
    {
        return $member->getKey() === $profile->getKey()
            ? Response::allow()
            : Response::deny('You cannot update this profile.');
    }

    /**
     * Determine whether the member can see private profile fields.
     */
    public function viewPrivate(User $member, User $profile): Response
    {
        return $this->isOwnerOrAdmin($member, $profile)
            ? Response::allow()
            : Response::deny('You cannot view private profile fields.');
    }

    /**
     * Determine whether the member owns the profile or is an administrator.
     */
    private function isOwnerOrAdmin(User $member, User $profile): bool
    {
        return $member->getKey() === $profile->getKey() || $member->isAdmin();
    }
}
