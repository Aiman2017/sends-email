<?php

namespace App\Policies;

use App\Models\User;

class UserAccessPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function access(User $user): bool
    {
        return $user->is_admin;
    }
}
