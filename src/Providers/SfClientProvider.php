<?php

namespace CfuPackage\SfClient\Providers;

use Illuminate\Support\ServiceProvider;

class SfClientProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/SfClient.php' => config_path('SfClient.php')
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'CfuPackage\SfClient\Contracts\SfClientInterface',
            'CfuPackage\SfClient\Wrappers\SfRestClient'
        );
    }
}
