<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helpers\FPL\Helper as FPLHelper;

use App\Models\Gameweek;
use App\Models\DreamTeam;

class GetDreamTeam extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fpl:get-dream-team';

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
        $current_gameweek = Gameweek::where('is_current', 'true')->first();

        if (!$current_gameweek) {
            \Log::info("[GetDreamTeam] There is no current gameweek...");
            return;
        }

        // remove old data for gameweek
        DreamTeam::where('gameweek_id', $current_gameweek->id)->delete();

        $dream_team = FPLHelper::getDreamTeam($current_gameweek->id);
        $validTeam = isset($dream_team["team"]);

        if (!$validTeam) {
            \Log::info("[GetDreamTeam] Unable to fetch dream team for gameweek '" . $current_gameweek->id . "'");
            return;
        }

        foreach ($dream_team["team"] as $player) {
            try {
                DreamTeam::insert([
                    'gameweek_id' => $current_gameweek->id,
                    'player_id' => $player["element"],
                    'points' => $player["points"],
                    'position' => $player["position"]
                ]);
            } catch (Exception $e) {
                \Log::error("[GetDreamTeam] " . $e->getMessage());
            }
        }
    }
}
