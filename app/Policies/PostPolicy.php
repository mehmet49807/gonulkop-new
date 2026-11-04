<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Determine whether the user can access the gender-filtered feed.
     */
    public function viewAny(User $user): Response
    {
        if (! $user->hasActiveFeedAccess()) {
            return Response::deny('Your feed access is not active.');
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can create a post.
     */
    public function create(User $user): Response
    {
        if (! $user->hasActiveFeedAccess()) {
            return Response::deny('Your publishing access is not active.');
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can view the post.
     */
    public function view(User $user, Post $post): Response
    {
        if (! $user->hasActiveFeedAccess()) {
            return Response::deny('Your feed access is not active.');
        }

        if ($post->status !== 'published') {
            return Response::deny('You cannot view this post.');
        }

        if ($post->user_id === $user->getKey() || $user->isAdmin()) {
            return Response::allow();
        }

        $authorGender = $post->user?->gender;

        if ($authorGender === null || $authorGender !== $user->gender?->opposite()) {
            return Response::deny('You cannot view this post.');
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can update the post.
     */
    public function update(User $user, Post $post): Response
    {
        return $post->user_id === $user->getKey() || $user->isAdmin()
            ? Response::allow()
            : Response::deny('You cannot update this post.');
    }

    /**
     * Determine whether the user can delete the post.
     */
    public function delete(User $user, Post $post): Response
    {
        return $post->user_id === $user->getKey() || $user->isAdmin()
            ? Response::allow()
            : Response::deny('You cannot delete this post.');
    }
}
