<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Mail;
use App\Mail\ClearFPLDataAlert;

use App\Jobs\ClearTeams;
use App\Jobs\ClearPlayers;
use App\Jobs\ClearGameweeks;
use App\Jobs\ClearFixtures;

class ClearFPLData extends Command
{
    // testing commit :)
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fpl:new-season';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear old FPL data ready for new season';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ini_set('memory_limit', '1024M');
        ini_set('max_execution_time', 0);

        Bus::chain([
            new ClearGameweeks,
            new ClearTeams,
            new ClearPlayers,
            new ClearFixtures
        ])->dispatch();

        Mail::to(env("FPL_ALERT_EMAIL"))->send(new ClearFPLDataAlert("Admin"));
        return Command::SUCCESS; 
    }
}
