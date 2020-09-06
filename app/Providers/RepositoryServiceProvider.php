<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    public function boot()
    {

    }

    public function register()
    {
        // parent::register();
        $this->app->bind(\App\Repositories\Contracts\UserRepositoryContract::class,     \App\Repositories\UserRepository::class);
        $this->app->bind(\App\Repositories\Contracts\ProfileRepositoryContract::class,  \App\Repositories\ProfileRepository::class);
        $this->app->bind(\App\Repositories\Contracts\PostRepositoryContract::class,     \App\Repositories\PostRepository::class);
        $this->app->bind(\App\Repositories\Contracts\CommentRepositoryContract::class,  \App\Repositories\CommentRepository::class);
    }

}