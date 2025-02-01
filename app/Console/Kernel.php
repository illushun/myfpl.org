<?php

namespace App\Console;

use DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {
     /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];
 
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        if (env('APP_ENV', 'local') === "production") {
            $schedule->command('fpl:update-gameweeks')->dailyAt('1:00');
            $schedule->command('fpl:update-fixtures')->dailyAt('1:20');
            $schedule->command('fpl:update-teams')->dailyAt('1:40');
            $schedule->command('fpl:update-players')->dailyAt('2:00');
            $schedule->command('fpl:predict-gameweek-fixtures')->dailyAt('2:30');

            $schedule->command('fpl:get-league-news')->hourly();
        }
    }   
}
