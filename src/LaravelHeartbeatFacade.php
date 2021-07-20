<?php

namespace Yadda\LaravelHeartbeat;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Yadda\LaravelHeartbeat\Skeleton\SkeletonClass
 */
class LaravelHeartbeatFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-heartbeat';
    }
}
