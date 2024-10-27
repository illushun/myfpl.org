<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Helpers\FPL\Helper as FPLHelper;
use App\Models\Player;
use App\Models\PlayerNews;
use App\Models\PlayerRole;
use App\Models\PlayerStat;
use App\Models\PlayerXg;

class ClearPlayers implements ShouldQueue
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
        $validSummary = isset($summary["elements"]);

        if (!$validSummary) {
            print_r("invalid summary\n");
            return;
        }

        PlayerXg::truncate();
        PlayerStat::truncate();
        PlayerRole::truncate();
        PlayerNews::truncate();
        Player::truncate();

        foreach ($summary["element_types"] as $index => $role) {
            PlayerRole::insert([
                "plural_name" => $role["plural_name"],
                "plural_name_short" => $role["plural_name_short"],
                "singular_name" => $role["singular_name"],
                "singular_name_short" => $role["singular_name_short"],
                "squad_select" => $role["squad_select"],
                "squad_min_select" => $role["squad_min_select"],
                "squad_max_select" => $role["squad_max_select"],
                "squad_min_play" => $role["squad_min_play"],
                "squad_max_play" => $role["squad_max_play"],
                "player_count" => $role["element_count"],
            ]);
        }

        foreach ($summary["elements"] as $index => $player) {
            $hash = md5(json_encode($player));
            $playerId = Player::insertGetId([
                "fpl_id" => $player["id"],
                "code" => $player["code"],
                "photo" => $player["photo"],
                "first_name" => $player["first_name"],
                "second_name" => $player["second_name"],
                "web_name" => $player["web_name"],
                "squad_number" => $player["squad_number"],
                "status" => $player["status"],
                "team_id" => $player["team"],
                "player_type" => $player["element_type"],
                "special" => $player["special"] ? 'true' : 'false',
                "hash" => $hash
            ]); 

            PlayerStat::insert([
                "player_id" => $playerId,
                "now_cost" => $player["now_cost"],
                "points_per_game" => (float) $player["points_per_game"],
                "selected_by_percent" => (float) $player["selected_by_percent"],
                "total_points" => $player["total_points"],
                "form" => (float) $player["form"],
                "value_form" => (float) $player["value_form"],
                "value_season" => (float) $player["value_season"],
                "minutes" => $player["minutes"],
                "goals_scored" => $player["goals_scored"],
                "assists" => $player["assists"],
                "clean_sheets" => $player["clean_sheets"],
                "goals_conceded" => $player["goals_conceded"],
                "own_goals" => $player["own_goals"],
                "penalties_saved" => $player["penalties_saved"],
                "penalties_missed" => $player["penalties_missed"],
                "yellow_cards" => $player["yellow_cards"],
                "red_cards" => $player["red_cards"],
                "saves" => $player["saves"],
                "bonus" => $player["bonus"],
                "bps" => $player["bps"],
                "influence" => (float) $player["influence"],
                "creativity" => (float) $player["creativity"],
                "threat" => (float) $player["threat"],
                "starts" => $player["starts"],
            ]);

            PlayerXg::insert([
                "player_id" => $playerId,
                "expected_goals" => (float) $player["expected_goals"],
                "expected_assists" => (float) $player["expected_assists"],
                "expected_goal_involvements" => (float) $player["expected_goal_involvements"],
                "expected_goals_conceded" => (float) $player["expected_goals_conceded"],
                "expected_goals_per_90" => (float) $player["expected_goals_per_90"],
                "saves_per_90" => (float) $player["saves_per_90"],
                "expected_assists_per_90" => (float) $player["expected_assists_per_90"],
                "expected_goal_involvements_per_90" => (float) $player["expected_goal_involvements_per_90"],
                "expected_goals_conceded_per_90" => (float) $player["expected_goals_conceded_per_90"],
                "goals_conceded_per_90" => (float) $player["goals_conceded_per_90"],
                "starts_per_90" => (float) $player["starts_per_90"],
                "clean_sheets_per_90" => (float) $player["clean_sheets_per_90"],
            ]);
        }    
        print_r("Done player reset!\n");
    }
}
