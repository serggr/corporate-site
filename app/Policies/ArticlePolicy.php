<?php

namespace Corp\Policies;

use Corp\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Corp\Article;


class ArticlePolicy
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
    
    public function save(User $user) {
        return $user->cando('ADD_ARTICLES');
    }
    
    public function edit(User $user) {
        return $user->cando('UPDATE_ARTICLES');
    } 
    
    public function destroy(User $user, Article $article) {
        return ($user->canDo('DELETE_ARTICLES') && $user->id == $article->user_id);
    }    
    
}
































