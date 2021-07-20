<?php

namespace Yadda\LaravelHeartbeat\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class HeartbeatController
{
    /**
     * Get the health status of the application
     *
     * @return View
     */
    public function index()
    {
        $now = Carbon::now();
        $last_schedule = Cache::get('schedule_heartbeat');
        $time_since_last_schedule = null;
        $schedule_ok = false;

        // We'll allow an extra bit of time between heartbeats and checks
        // to prevent any race conditions.
        $leeway = 1;

        if ($last_schedule) {
            $schedule_interval_mins = config('heartbeat.heartrate') + $leeway;
            $time_since_last_schedule = $now->diffInMinutes($last_schedule);
            $schedule_ok = $time_since_last_schedule < $schedule_interval_mins;
        }

        $last_queue = Cache::get('queue_heartbeat');
        $time_since_last_queue = null;
        $queue_ok = false;

        if ($last_queue) {
            $queue_interval_mins = config('heartbeat.heartrate') + $leeway;
            $time_since_last_queue = $now->diffInMinutes($last_queue);
            $queue_ok = $time_since_last_queue < $queue_interval_mins;
        }

        $job = DB::table('jobs')->where('payload', 'like', '%QueueHeartbeat%')->orderBy('available_at', 'ASC')->first();

        $status = $schedule_ok && $queue_ok ? 200 : 503;

        return response()
            ->view('laravel-heartbeat::status', compact(
                'schedule_ok',
                'last_schedule',
                'time_since_last_schedule',
                'queue_ok',
                'last_queue',
                'time_since_last_queue',
                'job'
            ), $status);
    }
}
