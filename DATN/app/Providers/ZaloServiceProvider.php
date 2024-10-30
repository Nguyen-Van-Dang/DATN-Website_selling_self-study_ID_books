<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Contracts\Factory as SocialiteFactory;
use SocialiteProviders\Manager\SocialiteWasCalled;
use SocialiteProviders\Zalo\ZaloExtendSocialite;

class ZaloServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->make(SocialiteFactory::class)->extend('zalo', function ($app, $config) {
            $config = $app['config']['services.zalo'];
            return new ZaloExtendSocialite(
                $app['request'], 
                $config['client_id'], 
                $config['client_secret'], 
                $config['redirect']
            );
        });
    }
}
