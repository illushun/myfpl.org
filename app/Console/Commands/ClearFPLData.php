<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;

use App\Jobs\ClearTeams;
use App\Jobs\ClearPlayers;
use App\Jobs\ClearGameweeks;
use App\Jobs\ClearFixtures;

class ClearFPLData extends Command
{
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
            new ClearTeams,
            new ClearPlayers,
            new ClearGameweeks,
            new ClearFixtures
        ])->dispatch();
        return Command::SUCCESS; 
    }
}