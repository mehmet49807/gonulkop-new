<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class MessagePolicy
{
    /**
     * Determine whether the member can start a conversation with the recipient.
     */
    public function create(User $member, User $recipient): Response
    {
        if ($member->gender?->opposite() !== $recipient->gender) {
            return Response::deny('You can only message members of the opposite gender.');
        }

        if ($recipient->profile_visibility === 'private'
            && $member->getKey() !== $recipient->getKey()
            && ! $member->isAdmin()) {
            return Response::deny('This member is not accepting messages.');
        }

        return Response::allow();
    }

    /**
     * Determine whether the member can view the conversation.
     */
    public function view(User $member, User $recipient): Response
    {
        if ($member->gender?->opposite() !== $recipient->gender) {
            return Response::deny('You can only view conversations with members of the opposite gender.');
        }

        if ($recipient->profile_visibility === 'private'
            && $member->getKey() !== $recipient->getKey()
            && ! $member->isAdmin()) {
            return Response::deny('This member is not accepting messages.');
        }

        return Response::allow();
    }
}
