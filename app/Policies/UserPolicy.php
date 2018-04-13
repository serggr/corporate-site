<?php

namespace Corp\Policies;

use Corp\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Corp\Article;


class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    
    public function create(User $user) {
        return $user->can('EDIT_USERS');
    }
    
    public function edit(User $user) {
        return $user->can('EDIT_USERS');
    } 
    
}
































