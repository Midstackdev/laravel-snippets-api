<?php

namespace App\Policies;

use App\Models\Step;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StepPolicy
{
    use HandlesAuthorization;

    /**
     * [update description]
     * @param  User   $user [description]
     * @param  Step   $step [description]
     * @return [type]       [description]
     */
    public function update(User $user, Step $step)
    {
        return $user->id === $step->snippet->user_id;
    }

    /**
     * [destroy description]
     * @param  User   $user [description]
     * @param  Step   $step [description]
     * @return [type]       [description]
     */
    public function destroy(User $user, Step $step)
    {
        return $user->id === $step->snippet->user_id;
    }
}
