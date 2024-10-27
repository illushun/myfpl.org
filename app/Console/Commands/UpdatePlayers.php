<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Exception;

use App\Helpers\FPL\Helper as FPLHelper;
use App\Models\Player;
use App\Models\PlayerNews;
use App\Models\PlayerStat;
use App\Models\PlayerXg;

class UpdatePlayers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fpl:update-players';

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
        $validSummary = isset($summary["elements"]);

        if (!$validSummary) {
            \Log::info("[UpdatePlayers] Invalid summary");
            return;
        }

        foreach ($summary["elements"] as $index => $player) {
            $FPLPlayer = Player::where('fpl_id', $player["id"])->first();

            if (!$FPLPlayer) {
                \Log::info("[UpdatePlayers] Creating player ID: '" . $player["id"] . "'");
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
                continue;
            }            

            // check if any data has been updated...
            $hash = md5(json_encode($player));
            if ($hash === $FPLPlayer->hash) {
                continue;
            }

            try {
                $FPLPlayer->status = $player["status"];
                $FPLPlayer->hash = $hash;
                $FPLPlayer->updated_at = date('Y-m-d H:i:s');
                $FPLPlayer->save();
            } catch (Exception $e) {
                \Log::error("[UpdatePlayers] FPLPlayer: " . $e->getMessage());
            }

            try {
                $FPLPlayerNews = PlayerNews::where('player_id', $FPLPlayer->id)->first();
                // make sure news field isn't empty
                if (!$FPLPlayerNews && $player["news"]) {
                    PlayerNews::insert([
                        "player_id" => $FPLPlayer->id,
                        "news" => $player["news"],
                    ]);
                } else {
                    if (!$player["news"]) {
                        PlayerNews::where('player_id', $FPLPlayer->id)->delete();
                    } else {
                        $FPLPlayerNews->news = $player["news"];
                        $FPLPlayerNews->updated_at = date('Y-m-d H:i:s');
                        $FPLPlayerNews->save();
                    }
                }
            } catch (Exception $e) {
                \Log::error("[UpdatePlayers] FPLPlayerNews: " . $e->getMessage());
            }

            try {
                $FPLPlayerStat = PlayerStat::where('player_id', $FPLPlayer->id)->first();
                $FPLPlayerStat->now_cost = $player["now_cost"];
                $FPLPlayerStat->points_per_game = (float) $player["points_per_game"];
                $FPLPlayerStat->selected_by_percent = (float) $player["selected_by_percent"];
                $FPLPlayerStat->total_points = $player["total_points"];
                $FPLPlayerStat->form = (float) $player["form"];
                $FPLPlayerStat->value_form = (float) $player["value_form"];
                $FPLPlayerStat->value_season = (float) $player["value_season"];
                $FPLPlayerStat->minutes = $player["minutes"];
                $FPLPlayerStat->goals_scored = $player["goals_scored"];
                $FPLPlayerStat->assists = $player["assists"];
                $FPLPlayerStat->clean_sheets = $player["clean_sheets"];
                $FPLPlayerStat->goals_conceded = $player["goals_conceded"];
                $FPLPlayerStat->own_goals = $player["own_goals"];
                $FPLPlayerStat->penalties_saved = $player["penalties_saved"];
                $FPLPlayerStat->penalties_missed = $player["penalties_missed"];
                $FPLPlayerStat->yellow_cards = $player["yellow_cards"];
                $FPLPlayerStat->red_cards = $player["red_cards"];
                $FPLPlayerStat->saves = $player["saves"];
                $FPLPlayerStat->bonus = $player["bonus"];
                $FPLPlayerStat->bps = $player["bps"];
                $FPLPlayerStat->starts = $player["starts"];
                $FPLPlayerStat->save();
            } catch (Exception $e) {
                \Log::error("[UpdatePlayers] FPLPlayerStat: " . $e->getMessage());
            }

            try {
                $FPLPlayerXg = PlayerXg::where('player_id', $FPLPlayer->id)->first();
                $FPLPlayerXg->expected_goals = (float) $player["expected_goals"];
                $FPLPlayerXg->expected_assists = (float) $player["expected_assists"];
                $FPLPlayerXg->expected_goal_involvements = (float) $player["expected_goal_involvements"];
                $FPLPlayerXg->expected_goals_conceded = (float) $player["expected_goals_conceded"];
                $FPLPlayerXg->expected_goals_per_90 = (float) $player["expected_goals_per_90"];
                $FPLPlayerXg->saves_per_90 = (float) $player["saves_per_90"];
                $FPLPlayerXg->expected_assists_per_90 = (float) $player["expected_assists_per_90"];
                $FPLPlayerXg->expected_goal_involvements_per_90 = (float) $player["expected_goal_involvements_per_90"];
                $FPLPlayerXg->expected_goals_conceded_per_90 = (float) $player["expected_goals_conceded_per_90"];
                $FPLPlayerXg->goals_conceded_per_90 = (float) $player["goals_conceded_per_90"];
                $FPLPlayerXg->starts_per_90 = (float) $player["starts_per_90"];
                $FPLPlayerXg->clean_sheets_per_90 = (float) $player["clean_sheets_per_90"];
                $FPLPlayerXg->save();
            } catch (Exception $e) {
                \Log::error("[UpdatePlayers] FPLPlayerXg: " . $e->getMessage());
            }
        }
    }
}
