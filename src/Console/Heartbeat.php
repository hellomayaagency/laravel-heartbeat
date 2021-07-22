<?php

namespace Maya\LaravelHeartbeat\Console;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maya\LaravelHeartbeat\Jobs\QueueHeartbeat;

class Heartbeat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'heartbeat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Signal that application is running';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Log::info('heartbeat');

        Cache::forever('schedule_heartbeat', Carbon::now());

        $job_count = DB::table('jobs')->where('payload', 'like', '%QueueHeartbeat%')->count('id');

        if ($job_count === 0) {
            Log::info('heartbeat - Queued QueueHeartbeat');

            QueueHeartbeat::dispatch()->delay(Carbon::now()->addMinute());
        }
    }
}
