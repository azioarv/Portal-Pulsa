<?php

namespace AzioArv\PortalPulsa;

use Illuminate\Support\ServiceProvider;

class PortalPulsaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    $this->publishes([__DIR__.'/PortalPulsaConfig.php' => config_path('PortalPulsaConfig.php')]  , 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $configFile = config_path('PortalPulsaConfig.php');

        if(file_exists($configFile))
        {
            $this->mergeConfigFrom($configFile , 'config');
        }else{
            $this->mergeConfigFrom(__DIR__.'/PortalPulsaConfig.php', 'config');
        }
        

        //

        $this->app->bind('run-portalpulsa' , function(){

            return new PortalPulsa;
        });
    
    }
}
