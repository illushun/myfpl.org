<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Exception;
use Illuminate\Support\Facades\Mail;
use App\Mail\UpdatePlayersAlert;

use App\Helpers\FPL\Helper as FPLHelper;
use App\Helpers\FPL\Season\SeasonHelper;
use App\Helpers\FPL\Season\GameweekHelper;

use App\Models\Player;
use App\Models\PlayerNews;
use App\Models\PlayerStat;
use App\Models\PlayerXg;
use App\Models\PlayerDetail;
use App\Models\Gameweek;
use App\Models\Team;

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

        $season = SeasonHelper::getCurrentSeason();
        if (!$season) {
            \Log::info("[UpdatePlayers] Unable to get current season");
            return;
        }

        $gameweek = GameweekHelper::getCurrentGameweek();
        if (!$gameweek) {
            \Log::info("[UpdateGameweeks] Unable to get current gameweek");
            return;
        }

        foreach ($summary["elements"] as $index => $player) {
            $FPLPlayer = Player
                ::where('season_id', $season->id)
                    ->where('fpl_id', $player["id"])
                    ->first();

            if (!$FPLPlayer) {
                \Log::info("[UpdatePlayers] Creating player ID: '" . $player["id"] . "'");

                $team = Team
                    ::where('fpl_id', $player["team"])
                        ->first();

                if (!$team) {
                    continue;
                }

                $hash = md5(json_encode($player));
                $playerId = Player::insertGetId([
                    "fpl_id" => $player["id"],
                    "season_id" => $season->id,
                    "first_name" => $player["first_name"],
                    "second_name" => $player["second_name"],
                    "web_name" => $player["web_name"],
                    "type" => $player["element_type"],
                    "hash" => $hash
                ]); 

                PlayerDetail::insert([
                    "player_id" => $playerId,
                    "code" => $player["code"],
                    "photo" => "https://resources.premierleague.com/premierleague/photos/players/110x140/p" . $player["code"] . ".png",
                    "status" => $player["status"],
                    "team_id" => $team->id,
                ]);

                PlayerStat::insert([
                    "player_id" => $playerId,
                    "gameweek_id" => $gameweek->id,
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
                    "gameweek_id" => $gameweek->id,
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
                $FPLPlayerDetail = PlayerDetail::where('player_id', $FPLPlayer->id)->first();
                $FPLPlayerDetail->status = $player["status"];
                $FPLPlayerDetail->updated_at = date('Y-m-d H:i:s');
                $FPLPlayerDetail->save();

                $FPLPlayer->hash = $hash;
                $FPLPlayer->updated_at = date('Y-m-d H:i:s');
                $FPLPlayer->save();
            } catch (Exception $e) {
                \Log::error("[UpdatePlayers] FPLPlayerDetail: " . $e->getMessage());
            }

            try {
                $FPLPlayerNews = PlayerNews
                    ::where('player_id', $FPLPlayer->id)
                        ->where('gameweek_id', $gameweek->id)
                        ->first();

                // make sure news field isn't empty
                if (!$FPLPlayerNews && $player["news"]) {
                    PlayerNews::insert([
                        "player_id" => $FPLPlayer->id,
                        "gameweek_id" => $gameweek->id,
                        "news" => $player["news"],
                    ]);
                } else {
                    if ($player["news"]) {
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

        Mail::to(env("FPL_ALERT_EMAIL"))->send(new UpdatePlayersAlert("Admin"));
    }
}
