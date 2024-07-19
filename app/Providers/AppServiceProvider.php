<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Post;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //  Create Post 
        Gate::define('create-post', function(User $user){
         return in_array($user->type, ['writer', 'admin']);
        });
        
        //  Admin Control
       Gate::define('admin-control', function(User $user){
         return $user->type == 'admin';
       });
       
        //  Update Post
       Gate::define('update-post', function(User $user, Post $post){
         return $user->id == $post->user_id;
       });
       
       
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
      Paginator::useBootstrap();
    }
}
