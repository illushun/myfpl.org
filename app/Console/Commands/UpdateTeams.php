<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Exception;

use App\Helpers\FPL\Helper as FPLHelper;
use App\Helpers\FPL\Season\SeasonHelper;

use App\Models\Team;
use App\Models\TeamStrength;

class UpdateTeams extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fpl:update-teams';

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
        $validSummary = isset($summary["teams"]);

        if (!$validSummary) {
            \Log::info("[UpdateTeams] Invalid Summary");
            return;
        }

        $season = SeasonHelper::getCurrentSeason();
        if (!$season) {
            \Log::info("[UpdateTeams] Unable to get current season");
            return;
        }

        foreach ($summary["teams"] as $index => $team) {
            $FPLTeam = Team
                ::where('season_id', $season->id)
                    ->where('fpl_id', $team["id"])
                    ->first();

            if (!$FPLTeam) {
                \Log::info("[UpdateTeams] Unable to find team with ID: '" . $team["id"] . "'");
                continue;
            }

            // check if any data has been updated...
            $hash = md5(json_encode($team));
            if ($hash === $FPLTeam->hash) {
                continue;
            }

            try {
                $FPLTeam->strength = $team["strength"];
                $FPLTeam->hash = $hash;
                $FPLTeam->updated_at = date('Y-m-d H:i:s');
                $FPLTeam->save();
            } catch (Exception $e) {
                \Log::error("[UpdateTeams] " . $e->getMessage());
            }
        }
    }
}
