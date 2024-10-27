<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Helpers\FPL\Helper as FPLHelper;
use App\Models\Gameweek;

class ClearGameweeks implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $summary = FPLHelper::getFPLSummary();
        $validSummary = isset($summary["events"]);

        if (!$validSummary) {
            print_r("invalid summary\n");
            return;
        }

        Gameweek::truncate();

        foreach ($summary["events"] as $index => $gameweek) {
            $hash = md5(json_encode($gameweek));
            Gameweek::insert([
                "name" => $gameweek["name"],
                "deadline" => $gameweek["deadline_time_epoch"],
                "deadline_offset" => $gameweek["deadline_time_game_offset"],
                "is_previous" => $gameweek["is_previous"] ? 'true' : 'false',
                "is_current" => $gameweek["is_current"] ? 'true' : 'false',
                "is_next" => $gameweek["is_next"] ? 'true' : 'false',
                "hash" => $hash,
            ]);
        } 

        print_r("Done gameweek inserts!\n");
    }
}
