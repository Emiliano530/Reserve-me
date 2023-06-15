<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;
 
class AdminAccessPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can access the admin route.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAdmin(User $user)
    {
        return $user->hasRole('admin');
    }
}
