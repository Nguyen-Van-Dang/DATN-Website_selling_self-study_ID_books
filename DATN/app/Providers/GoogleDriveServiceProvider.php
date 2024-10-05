<?php

namespace App\Providers;

use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;
use Masbug\Flysystem\GoogleDriveAdapter;
use League\Flysystem\Filesystem;

class GoogleDriveServiceProvider extends ServiceProvider
{
    // public function boot()
    // {
    //     Storage::extend('google', function ($app, $config) {
    //         $client = new Google_Client();
    //         $client->setClientId($config['clientId']);
    //         $client->setClientSecret($config['clientSecret']);
    //         $client->refreshToken($config['refreshToken']);
    //         $service = new Google_Service_Drive($client);
    //         $adapter = new GoogleDriveAdapter($service, $config['folderId']);
    //         return new Filesystem($adapter);
    //     });
    // }

    // public function boot()
    // {
    //     Storage::extend('google', function ($app, $config) {
    //         $client = new \Google_Client();
    //         $client->setClientId($config['clientId']);
    //         $client->setClientSecret($config['clientSecret']);
    //         $client->refreshToken($config['refreshToken']);
    //         $service = new \Google_Service_Drive($client);
    
    //         $adapter = new GoogleDriveAdapter($service, $config['folderId']);
    
    //         return new Filesystem($adapter);
    //     });
    // }
    public function boot()
    {
        Storage::extend('google', function($app, $config) {
            $client = new \Google\Client();
            $client->setClientId($config['clientId']);
            $client->setClientSecret($config['clientSecret']);
            $client->refreshToken($config['refreshToken']);
            $service = new \Google\Service\Drive($client);

            // $options = [];
            // if(isset($config['teamDriveId'])) {
            //     $options['teamDriveId'] = $config['teamDriveId'];
            // }
            // $adapter = new GoogleDriveAdapter($service, $config['folder'] ?? '/', $options);
            
            $adapter = new GoogleDriveAdapter($service, $config['folder'] ?? '/');
            $driver = new Filesystem($adapter);
            return new FilesystemAdapter($driver, $adapter);
        });
    }

    public function register()
    {
        //
    }
}


