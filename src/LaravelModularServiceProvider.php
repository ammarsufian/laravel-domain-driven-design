<?php

namespace Ammardaana\LaravelModular;

use Ammardaana\LaravelModular\Console\Commands\GenerateActionCommand;
use Ammardaana\LaravelModular\Console\Commands\GenerateControllerCommand;
use Ammardaana\LaravelModular\Console\Commands\GenerateDomainCommand;
use Ammardaana\LaravelModular\Console\Commands\GenerateDTOCommand;
use Ammardaana\LaravelModular\Console\Commands\GenerateEventCommand;
use Ammardaana\LaravelModular\Console\Commands\GenerateListenerCommand;
use Ammardaana\LaravelModular\Console\Commands\GenerateMiddlewareCommand;
use Ammardaana\LaravelModular\Console\Commands\GenerateModelCommand;
use Ammardaana\LaravelModular\Console\Commands\GenerateRequestCommand;
use Ammardaana\LaravelModular\Console\Commands\GenerateResourceCommand;
use Ammardaana\LaravelModular\Console\Commands\GenerateRuleCommand;
use Ammardaana\LaravelModular\Console\Commands\GenerateServiceCommand;
use Illuminate\Support\ServiceProvider;

class LaravelModularServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateDomainCommand::class,
                GenerateServiceCommand::class,
                GenerateActionCommand::class,
                GenerateDTOCommand::class,
                GenerateModelCommand::class,
                GenerateRuleCommand::class,
                GenerateResourceCommand::class,
                GenerateMiddlewareCommand::class,
                GenerateControllerCommand::class,
                GenerateEventCommand::class,
                GenerateListenerCommand::class,
                GenerateRequestCommand::class,
            ]);
        }
    }
}
