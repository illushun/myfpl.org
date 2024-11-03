<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Helpers\FPL\Helper as FPLHelper;
use App\Helpers\FPL\Season\SeasonHelper;

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
        
        $season = SeasonHelper::getCurrentSeason();
        if (!$season) {
            print_r("Unable to get current season\n");
            return;
        }

        //Team::truncate();
        //TeamStrength::truncate();
        Team::where('season_id', $season->id)->delete();

        foreach ($summary["teams"] as $index => $team) {
            $hash = md5(json_encode($team));
            $teamId = Team::insertGetId([
                "fpl_id" => $team["id"],
                "season_id" => $season->id,
                "name" => $team["name"],
                "short_name" => $team["short_name"],
                "strength" => $team["strength"],
                "code" => $team["code"],
                "pulse_id" => $team["pulse_id"],
                "unavailable" => $team["unavailable"] ? 'true' : 'false',
                "hash" => $hash
            ]);
            
            TeamStrength::insert([
                "team_id" => $teamId,
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
