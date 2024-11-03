<?php

/**
 * Manipulate FPL Data from API
 *
 * Creator: Stuart Davey
 */

namespace App\Helpers\FPL\Season;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

use App\Helpers\FPL\Helper as FPLHelper;
use App\Helpers\FPL\Season\SeasonHelper;

use App\Models\Team;
use App\Models\Gameweek;
use App\Models\Player;
use App\Models\Fixture;

class GameweekHelper {

    protected const GAMEWEEK_EXPIRE=86400; // 1 day 
    public const CACHE_KEY="App.Helpers.FPL";

    /* Keys */
    private static function _getGameweekKey(): string {
        return self::CACHE_KEY . ".Gameweek";
    }

    /* Get */
    public static function getCurrentGameweek(): mixed {
        $cacheKey = self::_getGameweekKey() . ".Current";
        return Cache::remember($cacheKey, self::GAMEWEEK_EXPIRE, function () {
            $currentSeason = SeasonHelper::getCurrentSeason();

            $gameweek = Gameweek
                ::where('is_current', 'true')
                    ->where('season_id', $currentSeason->id)
                    ->first();

            if (!$gameweek) {
                $gameweek = Gameweek
                    ::where('is_next', 'true')
                        ->where('season_id', $currentSeason->id)
                        ->first();
            }
            return $gameweek;
       });
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
}
