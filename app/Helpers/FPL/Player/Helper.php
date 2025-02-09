<?php

/**
 * Manipulate FPL Data from API
 *
 * Creator: Stuart Davey
 */

namespace App\Helpers\FPL\Player;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

use App\Helpers\FPL\Helper as FPLHelper;

use App\Models\Team;
use App\Models\Gameweek;
use App\Models\Player;
use App\Models\PlayerStat;
use App\Models\Fixture;

class Helper {

    protected const GAMEWEEK_EXPIRE=86400; // 1 day 
    protected const TEAM_EXPIRE=60;
    protected const PLAYER_EXPIRE=60;
    protected const FIXTURE_EXPIRE=60;
    public const CACHE_KEY="App.Helpers.FPL";

    /* Keys */
    private static function _getPlayerKey(): string {
        return self::CACHE_KEY . "Player";
    }

    /* Get */
    public static function getPlayers(): mixed {
        $cacheKey = self::_getPlayerKey() . ".All";
        return Cache::remember($cacheKey, self::PLAYER_EXPIRE, function () {
            return Player::paginate(10);
        });
    }

    /**
     * Get players based on points_per_game
     */
    public static function getTopPlayers(): mixed {
        $cacheKey = self::_getPlayerKey() . ".Top";
        return Cache::remember($cacheKey, self::PLAYER_EXPIRE, function () {
            return Player
                ::select(['ps.points_per_game', 'ps.selected_by_percent', 'ps.value_season', 'player.web_name', 't.code', 'pr.singular_name'])
                    ->join('player_stat as ps', 'player.id', '=', 'ps.player_id')
                    ->join('team as t', 'player.team_id', '=', 't.id')
                    ->join('player_role as pr', 'player.player_type', '=', 'pr.id')
                    ->orderBy('ps.points_per_game', 'desc')
                    ->orderBy('ps.value_season', 'desc')
                    ->limit(4)
                    ->get();
        });
    }

    public static function getPlayer(int $player_id): mixed {
        $cacheKey = self::_getPlayerKey() . $player_id;
        return Cache::remember($cacheKey, self::PLAYER_EXPIRE, function () use ($player_id) {
            return Player::where('id', $player_id)->first(); 
        }); 
    }

    /**
     * Based on numerous filters, get the upcoming
     * players
     */
    public static function getPromisingPlayers($filters = []): mixed {
        if (!$filters) {
            $filters["ppg"] = 2.0;
            $filters["form"] = 5.0;
        }

        $validFilters = [
            "position",
            "team",
            "cost",
            "ppg",
            "form",
        ];

        return Player
            ::select([
                'player.id',
                'player.web_name',
                'player_stat.form',
                'player_stat.value_form',
                'player_stat.value_season',
                'player_stat.now_cost',
                'player_stat.points_per_game',
                'player_stat.selected_by_percent'
            ])
                ->join('player_stat', 'player_stat.player_id', '=', 'player.id')
                ->where('player_stat.points_per_game', '>=', $filters["ppg"])
                ->get();
    }

    public static function getPredictedGoalsByGameweek38(int $player_id): mixed {
        $cacheKey = self::_getPlayerKey() . ".PredictedGoals." . $player_id;
        return Cache::remember($cacheKey, self::PLAYER_EXPIRE, function () use ($player_id) {
            $stat_records = PlayerStat
                ::select(['goals_scored', 'gameweek_id'])
                ->where('player_id', $player_id)
                ->orderBy('gameweek_id')
                ->get();

            if ($stat_records->count() < 2) {
                // Not enough data to predict
                // Return current total goals as prediction
                return $stat_records->last()->goals_scored ?? 0;
            }

            // calc goals per gameweek by finding the diff
            // between consecutive gameweeks
            $goals_per_gameweek = [];
            for ($i = 1; $i < $stat_records->count(); $i++) {
                $prev_goals = $stat_records[$i - 1]->goals_scored;
                $curr_goals = $stat_records[$i]->goals_scored;

                $goals_per_gameweek[] = $curr_goals - $prev_goals;
            }

            // average goals per gameweek
            $average_goals_per_gameweek = collect($goals_per_gameweek)->average();

            // get the last recorded gameweek and total goals
            $last_gameweek = $stat_records->last()->gameweek_id;
            $curr_total_goals = $stat_records->last()->goals_scored;

            // predict future goals based on remaining gameweeks
            $remaining_gameweeks = 38 - $last_gameweek;

            $predicted_future_goals = $remaining_gameweeks * $average_goals_per_gameweek;

            // return the predicted total by gameweek 38
            return $curr_total_goals + $predicted_future_goals;
        }); 
    }
}
