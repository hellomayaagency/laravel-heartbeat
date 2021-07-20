<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    /*
    |--------------------------------------------------------------------------
    | Heartbeat Interval Time
    |--------------------------------------------------------------------------
    |
    | Time in minutes between heartbeat jobs. This will confirm that
    | the queue is working correctly and will make the status page
    | return 200
    */
    'heartrate' => 10,

    /*
    |--------------------------------------------------------------------------
    | Heartbeat status page layout
    |--------------------------------------------------------------------------
    |
    | The heartbeat status page will extend this view. Defaults to
    | 'layouts.app`.
    */
    'layout' => 'layouts.app',
];
