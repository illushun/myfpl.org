<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Exception;

use App\Helpers\FPL\Helper as FPLHelper;
use App\Models\Gameweek;

class UpdateGameweeks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fpl:update-gameweeks';

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
        $summary = FPLHelper::getFPLSummary();
        $validSummary = isset($summary["events"]);

        if (!$validSummary) {
            \Log::info("[UpdateGameweeks] Invalid summary");
            return;
        }

        foreach ($summary["events"] as $index => $gameweek) {
            $FPLGameweek = Gameweek::find($gameweek["id"]);

            if (!$FPLGameweek) {
                \Log::info("[UpdateGameweeks] Unable to find gameweek ID: '" . $gameweek["id"] . "'");
                continue;
            }

            // check if any data has been updated...
            $hash = md5(json_encode($gameweek));
            if ($hash === $FPLGameweek->hash) {
                continue;
            }

            try {
                $FPLGameweek->deadline_offset = $gameweek["deadline_time_game_offset"];
                $FPLGameweek->is_previous = $gameweek["is_previous"] ? 'true' : 'false';
                $FPLGameweek->is_current = $gameweek["is_current"] ? 'true' : 'false';
                $FPLGameweek->is_next = $gameweek["is_next"] ? 'true' : 'false';
                $FPLGameweek->hash = $hash;
                $FPLGameweek->updated_at = date('Y-m-d H:i:s');
                $FPLGameweek->save();
            } catch (Exception $e) {
                \Log::error("[UpdateGameweeks] " . $e->getMessage());
            }
        }
    }
}