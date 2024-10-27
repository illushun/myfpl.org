<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Exception;

use App\Helpers\FPL\Helper as FPLHelper;
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

        foreach ($summary["teams"] as $index => $team) {
            $FPLTeam = Team::find($team["id"]);

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
                $FPLTeam->win = $team["win"];
                $FPLTeam->draw = $team["draw"];
                $FPLTeam->loss = $team["loss"];
                $FPLTeam->played = $team["played"];
                $FPLTeam->position = $team["position"];
                $FPLTeam->points = $team["points"];
                $FPLTeam->form = (float) $team["form"];
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
