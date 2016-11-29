<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('App\Contracts\MailboxContract', 'App\Repositories\MailboxRepository');
        $this->app->bind('App\Contracts\CategoryGroupsContract', 'App\Repositories\CategoryGroupRepository');
        $this->app->bind('App\Contracts\UserContract', 'App\Repositories\UserRepository');
        $this->app->bind('App\Contracts\ArticleContract', 'App\Repositories\ArticleRepository');
    }
}
