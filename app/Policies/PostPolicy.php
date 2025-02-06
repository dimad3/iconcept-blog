<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    public function managePost(User $user, Post $post): Response
    {
        return $user->id === $post->user_id
                ? Response::allow()
                : Response::denyWithStatus(404);
    }

    // /**
    //  * Determine whether the user can update the model.
    //  */
    // public function update(User $user, Post $post): bool
    // {
    //     return false;
    // }

    // /**
    //  * Determine whether the user can delete the model.
    //  */
    // public function delete(User $user, Post $post): bool
    // {
    //     return false;
    // }
}
