<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class FeedPolicy
{
    /**
     * Determine whether the member can access the gender-filtered feed.
     */
    public function view(User $user): Response
    {
        if (! $user->hasActiveFeedAccess()) {
            return Response::deny('Your feed access is not active.');
        }

        return Response::allow();
    }

    /**
     * Determine whether the member can publish posts to the feed.
     */
    public function publish(User $user): Response
    {
        if (! $user->hasActiveFeedAccess()) {
            return Response::deny('Your publishing access is not active.');
        }

        return Response::allow();
    }
}
