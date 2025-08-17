<?php

namespace Ammardaana\LaravelModular;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ammardaana\LaravelModular\Skeleton\SkeletonClass
 */
class LaravelModularFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-modular';
    }
}
