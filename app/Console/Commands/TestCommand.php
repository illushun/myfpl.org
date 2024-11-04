<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Mail;
use App\Mail\FPLMail;

use App\Helpers\FPL\Helper as FPLHelper;
use App\Helpers\FPL\Season\GameweekHelper;
use App\Helpers\FPL\Season\SeasonHelper;

use App\Jobs\ClearFixtures;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fpl:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ini_set('memory_limit', '1024M');
        ini_set('max_execution_time', 0);

        Bus::chain([
            new ClearFixtures
        ])->dispatch();
        return Command::SUCCESS; 
    }
}
