<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes();

        // Load the routes for broadcasting
        require base_path('routes/channels.php');
    }
}
