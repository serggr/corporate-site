<?php

namespace Corp\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Corp\Article;
use Corp\Permission;
use Corp\Menu;
use Corp\Policies\ArticlePolicy;
use Corp\Policies\PermissionPolicy;
use Corp\Policies\MenusPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [        
        Article::class => ArticlePolicy::class,
        Permission::class => PermissionPolicy::class,
        Menu::class => MenusPolicy::class,   
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        
        
        
        
        Gate::define('VIEW_ADMIN', function ($user){
            return $user->canDo(['VIEW_ADMIN'],TRUE);
            
        });
        
        Gate::define('VIEW_ADMIN_ARTICLES', function ($user){
            return $user->canDo('VIEW_ADMIN_ARTICLES',FALSE);
            
        });  
        
        Gate::define('EDIT_USERS', function ($user){
            return $user->canDo('EDIT_USERS',FALSE);
            
        });        
        
        Gate::define('VIEW_ADMIN_MENU', function ($user){
            return $user->canDo('VIEW_ADMIN_MENU',FALSE);
            
        });        
   
        

        //
    }
}
