<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Schedule::command('fpl:update-gameweeks')->hourlyAt(10);
Schedule::command('fpl:update-fixtures')->everyThreeMinutes();
Schedule::command('fpl:update-teams')->everyThreeMinutes();
Schedule::command('fpl:update-players')->everyThreeMinutes();
Schedule::command('fpl:get-dream-team')->hourlyAt(21);
Schedule::command('fpl:predict-gameweek-fixtures')->hourlyAt(20);
