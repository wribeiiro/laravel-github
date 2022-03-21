<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Interfaces\SocialAuthInterface;
use App\Services\{GithubAuthService, DiscordAuthService};

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            SocialAuthInterface::class,
            GithubAuthService::class
        );

        $this->app->bind(
            SocialAuthInterface::class,
            DiscordAuthService::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
