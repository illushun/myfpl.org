<?php

/**
 * Manipulate FPL Data from API
 *
 * Creator: Stuart Davey
 */

namespace App\Helpers\FPL;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

use App\Helpers\FPL\Helper as FPLHelper;

use App\Models\Team;
use App\Models\Gameweek;
use App\Models\Player;
use App\Models\Fixture;

class Data {

    protected const GAMEWEEK_EXPIRE=86400; // 1 day 
    protected const TEAM_EXPIRE=60;
    protected const PLAYER_EXPIRE=60;
    protected const FIXTURE_EXPIRE=60;
    public const CACHE_KEY="App.Helpers.FPL";

    /* Keys */
    private static function _getGameweekKey(): string {
        return self::CACHE_KEY . ".Gameweek";
    }

    private static function _getTeamKey(): string {
        return self::CACHE_KEY . "Team";
    }

    private static function _getPlayerKey(): string {
        return self::CACHE_KEY . "Player";
    }

    private static function _getFixtureKey(): string {
        return self::CACHE_KEY . "Fixture";
    }

    /* Get */
    public static function getCurrentGameweek(): mixed {
        $cacheKey = self::_getGameweekKey() . ".Current";
        return Cache::remember($cacheKey, self::GAMEWEEK_EXPIRE, function () {
            $gameweek = Gameweek::where('is_current', 'true')->first();
            if (!$gameweek) {
                $gameweek = Gameweek::where('is_next', 'true')->first();
            }
            return $gameweek;
       });
    }

    public static function getTeams(): mixed {
        $cacheKey = self::_getTeamKey() . ".All";
        return Cache::remember($cacheKey, self::TEAM_EXPIRE, function () {
            return Team::paginate(10);
        });
    }

    /**
     * Get teams based on wins
     */
    public static function getTopTeams(): mixed {
        $cacheKey = self::_getTeamKey(). ".Top";
        return Cache::remember($cacheKey, self::TEAM_EXPIRE, function () {
            return Team
                ::orderBy('position', 'desc')
                    ->orderBy('name', 'asc')
                    ->limit(4)
                    ->get();
        });
    }

    public static function getTeam(int $team_id): mixed {
        $cacheKey = self::_getTeamKey() . $team_id;
        return Cache::remember($cacheKey, self::TEAM_EXPIRE, function () use ($team_id) {
            return Team::where('id', $team_id)->first();
        });
    }

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

    public static function getFixtures(int $gameweek_id): mixed {
        $cacheKey = self::_getFixtureKey() . ".GW." . $gameweek_id;
        return Cache::remember($cacheKey, self::FIXTURE_EXPIRE, function () use ($gameweek_id) {
            return Fixture::where('gameweek_id', $gameweek_id)->get(); 
        });
    }

    public static function getTeamFixtures(int $gameweek_id, int $team_id): mixed {
        $cacheKey = self::_getFixtureKey() . ".GW." . $gameweek_id . ".Team." . $team_id;
        return Cache::remember($cacheKey, self::FIXTURE_EXPIRE, function () use ($gameweek_id, $team_id) {
            return Fixture
                ::where('gameweek_id', $gameweek_id)
                ->where(function ($query) use ($team_id) {
                    $query->where('team_a', $team_id)
                        ->orWhere('team_h', $team_id);
                })
                ->get();
        });
    }

    public static function getWinRate(int $gameweek_id, int $team_id): float {
        $wins = 0;

        // loop through each gameweek up to specified gameweek (1 - 38)
        for ($i = 1; $i <= $gameweek_id; $i++) {
            // fetch the fixtures for the current gameweek
            $fixtures = self::getTeamFixtures($i, $team_id);

            foreach ($fixtures as $fixture) {
                $isHomeTeam = $fixture->team_h === $team_id;
                $teamWon = $isHomeTeam
                    ? $fixture->team_h_score > $fixture->team_a_score
                    : $fixture->team_a_score > $fixture->team_h_score;

                if ($teamWon) {
                    $wins++;
                }
            }
        }
        return round(($wins / $gameweek_id) * 100.0, 2);
    }

    public static function getGameweekPrediction(int $gameweek_id): mixed {
        $cacheKey = self::_getGameweekKey() . "." . $gameweek_id . ".Prediction";
        return Cache::remember($cacheKey, self::GAMEWEEK_EXPIRE, function () use ($gameweek_id) {
            $fixtures = self::getFixtures($gameweek_id);
            $predictions = [];

            foreach ($fixtures as $fixture) {
                $homeTeam = $fixture->homeTeam;
                $awayTeam = $fixture->awayTeam;

                // calc win rates
                $homeWinRate = self::getWinRate($gameweek_id, $fixture->team_h);
                $awayWinRate = self::getWinRate($gameweek_id, $fixture->team_a);

                // calc win rate difference
                $winRateDiff = abs($homeWinRate - $awayWinRate);

                // get stats
                $homeStrengths = $homeTeam->strengthStats;
                $awayStrengths = $awayTeam->strengthStats;

                $homeAttackStrength = $homeStrengths->strength_attack_home;
                $homeDefenceStrength = $homeStrengths->strength_defence_home;
                $homeOverallStrength = $homeStrengths->strength_overall_home;

                $awayAttackStrength = $awayStrengths->strength_attack_away;
                $awayDefenceStrength = $awayStrengths->strength_defence_away;
                $awayOverallStrength = $awayStrengths->strength_overall_home;

                // if win rate difference is small, compare attack & defence
                if ($winRateDiff < 20) {
                    $attackDiff = abs($homeAttackStrength - $awayDefenceStrength);

                    // if there is a large difference in attack & defence
                    if ($attackDiff > 50) {
                        if ($homeAttackStrength > $awayDefenceStrength) {
                            $predictions[$fixture->id]["home"] = ["team" => $homeTeam, "outcome" => "win"];
                            $predictions[$fixture->id]["away"] = ["team" => $awayTeam, "outcome" => "loss"];
                        } else {
                            $predictions[$fixture->id]["home"] = ["team" => $homeTeam, "outcome" => "loss"];
                            $predictions[$fixture->id]["away"] = ["team" => $awayTeam, "outcome" => "win"];
                        }
                    } else {
                        // if strengths are evenly matched
                        $predictions[$fixture->id]["home"] = ["team" => $homeTeam, "outcome" => "draw"];
                        $predictions[$fixture->id]["away"] = ["team" => $awayTeam, "outcome" => "draw"];
                    }
                } else {
                    // predict winner based on higher win rate
                    if ($homeWinRate > $awayWinRate) {
                        $predictions[$fixture->id]["home"] = ["team" => $homeTeam, "outcome" => "win"];
                        $predictions[$fixture->id]["away"] = ["team" => $awayTeam, "outcome" => "loss"];
                    } else {
                        $predictions[$fixture->id]["home"] = ["team" => $homeTeam, "outcome" => "loss"];
                        $predictions[$fixture->id]["away"] = ["team" => $awayTeam, "outcome" => "win"];

                    }
                }

                // additional check if win rates are equal using difficulty and overall strength
                if ($homeWinRate === $awayWinRate) {
                    if ($fixture->team_h_difficulty < $fixture->team_a_difficulty) {
                        // if home team's difficulty is lower, choose home team
                        $predictions[$fixture->id]["home"] = ["team" => $homeTeam, "outcome" => "win"];
                        $predictions[$fixture->id]["away"] = ["team" => $awayTeam, "outcome" => "loss"];
                    } elseif ($fixture->team_a_difficulty < $fixture->team_h_difficulty) {
                        // if away team's difficulty is lower, choose away team
                        $predictions[$fixture->id]["home"] = ["team" => $homeTeam, "outcome" => "loss"];
                        $predictions[$fixture->id]["away"] = ["team" => $awayTeam, "outcome" => "win"];
                    } else {
                        // if difficulties are equal, compare strengths
                        if ($homeAttackStrength > $awayDefenceStrength ||
                            $homeDefenceStrength > $awayAttackStrength) {
                            $predictions[$fixture->id]["home"] = ["team" => $homeTeam, "outcome" => "win"];
                            $predictions[$fixture->id]["away"] = ["team" => $awayTeam, "outcome" => "loss"];
                        } elseif ($awayAttackStrength > $homeDefenceStrength ||
                            $awayDefenceStrength > $homeAttackStrength) {
                            $predictions[$fixture->id]["home"] = ["team" => $homeTeam, "outcome" => "loss"];
                            $predictions[$fixture->id]["away"] = ["team" => $awayTeam, "outcome" => "win"];
                        } elseif ($homeOverallStrength > $awayOverallStrength) {
                            $predictions[$fixture->id]["home"] = ["team" => $homeTeam, "outcome" => "win"];
                            $predictions[$fixture->id]["away"] = ["team" => $awayTeam, "outcome" => "loss"];
                        } elseif ($awayOverallStrength > $homeOverallStrength) {
                            $predictions[$fixture->id]["home"] = ["team" => $homeTeam, "outcome" => "loss"];
                            $predictions[$fixture->id]["away"] = ["team" => $awayTeam, "outcome" => "win"];
                        }
                    } 
                }
            } 

            return $predictions;
        });
    }

    /* Update */
    public static function updateAllGameweeks(): bool {
        
    }

    public static function updateGameweek(int $gameweek_id): bool {
        $gameweek = Gameweek::where('id', $gameweek_id)->first();
        
        if (!$gameweek) {
            return false;
        }

        $summary = FPLHelper::getFPLSummary();
        $validSummary = isset($summary["events"]);

        if (!$validSummary) {
            return false;
        }

        $summary = $summary["events"];
        $validGameweekData = isset($summary[$gameweek->id - 1]);

        if (!$validGameweekData) {
            return false;
        }

        $gameweekData = $summary[$gameweek->id - 1];

        if ($gameweekData["id"] !== $gameweek->id) {
            // need to fallback to something here just incase they send jumbled data...
            return false;
        }

        $requiredData = [
            "name" => "",
            "deadline_time_epoch" => 0,
            "deadline_time_game_offset" => 0,
            "is_previous" => false,
            "is_current" => false,
            "is_next" => false,
        ];

        foreach ($requiredData as $name) {
            if (
                $name === "is_previous" ||
                $name === "is_current" ||
                $name === "is_next"
            ) {
                $gameweekData[$name] = $gameweekData[$name] ? 'true' : 'false';
            }
            $requiredData[$name] = $gameweekData[$name];
        }

        $requiredData["deadline"] = $requiredData["deadline_time_epoch"];
        $requiredData["deadline_offset"] = $requiredData["deadline_time_game_offset"];
        unset($requiredData["deadline_time_epoch"]);
        unset($requiredData["deadline_time_game_offset"]);

        return Gameweek::update($requiredData, $gameweek->id);
    }
    
    public static function updateAllPlayers(): bool {
    
    }

    public static function updateGameweekPlayers(int $gameweek_id): bool {
    
    }

    public static function updatePlayer(int $player_id): bool {
        
    }
}
