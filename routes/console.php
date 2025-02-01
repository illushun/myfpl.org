<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Schedule::command('fpl:update-gameweeks')->dailyAt('1:00');
Schedule::command('fpl:update-fixtures')->dailyAt('1:20');
Schedule::command('fpl:update-teams')->dailyAt('1:40');
Schedule::command('fpl:update-players')->dailyAt('2:00');
Schedule::command('fpl:get-dream-team')->dailyAt('2:30');
Schedule::command('fpl:predict-gameweek-fixtures')->dailyAt('3:00');

Schedule::command('fpl:get-league-news')->hourly();
