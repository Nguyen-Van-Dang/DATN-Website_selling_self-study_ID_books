<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ChatRepository;
use App\Interfaces\ChatRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Bind interface với repository
        $this->app->bind(ChatRepositoryInterface::class, ChatRepository::class);
    }

    public function boot()
    {
        //
    }
}
