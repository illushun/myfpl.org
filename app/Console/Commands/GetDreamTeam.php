<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\GetDreamTeamAlert;

use App\Helpers\FPL\Helper as FPLHelper;
use App\Helpers\FPL\Season\SeasonHelper;
use App\Helpers\FPL\Season\GameweekHelper;

use App\Models\Gameweek;
use App\Models\DreamTeam;
use App\Models\Player;

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
        $season = SeasonHelper::getCurrentSeason();
        if (!$season) {
            \Log::info("[GetDreamTeam] Unable to get current season");
            return;
        }

        $gameweek = GameweekHelper::getCurrentGameweek();
        if (!$gameweek) {
            \Log::info("[GetDreamTeam] Unable to get current gameweek");
            return;
        }

        // remove old data for gameweek
        DreamTeam::where('gameweek_id', $gameweek->id)->delete();

        $dream_team = FPLHelper::getDreamTeam($gameweek->id);
        $validTeam = isset($dream_team["team"]);

        if (!$validTeam) {
            \Log::info("[GetDreamTeam] Unable to fetch dream team for gameweek '" . $current_gameweek->id . "'");
            return;
        }

        foreach ($dream_team["team"] as $player) {
            try {
                $FPLPlayer = Player
                    ::where('season_id', $season->id)
                        ->where('fpl_id', $player["element"])
                        ->first();

                DreamTeam::insert([
                    'gameweek_id' => $gameweek->id,
                    'player_id' => $FPLPlayer->id,
                    'points' => $player["points"],
                    'position' => $player["position"]
                ]);
            } catch (Exception $e) {
                \Log::error("[GetDreamTeam] " . $e->getMessage());
            }
        }

        Mail::to(env("FPL_ALERT_EMAIL"))->send(new GetDreamTeamAlert("Admin"));
    }
}
