<?php

namespace App\Policies;

use App\Models\Snippet;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SnippetPolicy
{
    use HandlesAuthorization;

    /**
     * [show description]
     * @param  User    $user    [description]
     * @param  Snippet $snippet [description]
     * @return [type]           [description]
     */
    public function show(?User $user, Snippet $snippet)
    {
        if ($snippet->isPublic()) {
            return true;
        }

        return optional($user)->id === $snippet->user_id;
    }

    /**
     * [update description]
     * @param  User    $user    [description]
     * @param  Snippet $snippet [description]
     * @return [type]           [description]
     */
    public function update(User $user, Snippet $snippet)
    {
        return $user->id === $snippet->user_id;
    }

    /**
     * [destroy description]
     * @param  User    $user    [description]
     * @param  Snippet $snippet [description]
     * @return [type]           [description]
     */
    public function destroy(User $user, Snippet $snippet)
    {
        return $user->id === $snippet->user_id;
    }


    /**
     * [storeStep description]
     * @param  User    $user    [description]
     * @param  Snippet $snippet [description]
     * @return [type]           [description]
     */
    public function storeStep(User $user, Snippet $snippet)
    {
        return $user->id === $snippet->user_id;
    }
}
