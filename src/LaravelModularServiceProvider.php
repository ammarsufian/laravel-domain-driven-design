<?php

namespace Ammardaana\LaravelModular;

use Ammardaana\LaravelModular\Console\Commands\GenerateActionCommand;
use Ammardaana\LaravelModular\Console\Commands\GenerateControllerCommand;
use Ammardaana\LaravelModular\Console\Commands\GenerateDomainCommand;
use Ammardaana\LaravelModular\Console\Commands\GenerateDTOCommand;
use Ammardaana\LaravelModular\Console\Commands\GenerateServiceCommand;
use Ammardaana\LaravelModular\Console\Commands\Integrations\GenerateConnectorCommand;
use Ammardaana\LaravelModular\Console\Commands\Integrations\GenerateIntegrationCommand;
use Illuminate\Support\ServiceProvider;

class LaravelModularServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('laravel-modular.php'),
            ], 'config');

            $this->commands([
                GenerateDomainCommand::class,
                GenerateServiceCommand::class,
                GenerateActionCommand::class,
                GenerateDTOCommand::class,
//                GenerateIntegrationCommand::class,
//                GenerateConnectorCommand::class,
                GenerateControllerCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'laravel-modular');

        // Register the main class to use with the facade
        $this->app->singleton('laravel-modular', function () {
            return new LaravelModular;
        });
    }
}
