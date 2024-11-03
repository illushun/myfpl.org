<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\FPLMail;

use App\Helpers\FPL\Helper as FPLHelper;
use App\Helpers\FPL\Season\GameweekHelper;
use App\Helpers\FPL\Season\SeasonHelper;


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
        $name = "Admin";
        Mail::to(env("FPL_ALERT_EMAIL"))->send(new FPLMail($name));
    }
}
