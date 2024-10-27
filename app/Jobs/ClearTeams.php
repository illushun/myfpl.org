<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Helpers\FPL\Helper as FPLHelper;
use App\Models\Team;
use App\Models\TeamStrength;

class ClearTeams implements ShouldQueue
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
        $validSummary = isset($summary["teams"]);

        if (!$validSummary) {
            print_r("invalid summary\n");
            return;
        }

        Team::truncate();
        TeamStrength::truncate();

        foreach ($summary["teams"] as $index => $team) {
            $hash = md5(json_encode($team));
            Team::insert([
                "id" => $team["id"],
                "name" => $team["name"],
                "short_name" => $team["short_name"],
                "team_division" => $team["team_division"],
                "win" => $team["win"],
                "draw" => $team["draw"],
                "loss" => $team["loss"],
                "played" => $team["played"],
                "position" => $team["position"],
                "points" => $team["points"],
                "form" => (float) $team["form"],
                "strength" => $team["strength"],
                "code" => $team["code"],
                "pulse_id" => $team["pulse_id"],
                "unavailable" => $team["unavailable"] ? 'true' : 'false',
                "hash" => $hash
            ]);
            
            TeamStrength::insert([
                "team_id" => $team["id"],
                "strength_overall_home" => $team["strength_overall_home"],
                "strength_overall_away" => $team["strength_overall_away"],
                "strength_attack_home" => $team["strength_attack_home"],
                "strength_attack_away" => $team["strength_attack_away"],
                "strength_defence_home" => $team["strength_defence_home"],
                "strength_defence_away" => $team["strength_defence_away"]
            ]); 
        }

        print_r("Done team reset!\n");
    }
}
