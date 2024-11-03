<?php

/**
 * Manipulate FPL Data from API
 *
 * Creator: Stuart Davey
 */

namespace App\Helpers\FPL\Fixture;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

use App\Helpers\FPL\Helper as FPLHelper;

use App\Models\Team;
use App\Models\Gameweek;
use App\Models\Player;
use App\Models\Fixture;

class Helper {

    protected const GAMEWEEK_EXPIRE=86400; // 1 day 
    protected const TEAM_EXPIRE=60;
    protected const PLAYER_EXPIRE=60;
    protected const FIXTURE_EXPIRE=60;
    public const CACHE_KEY="App.Helpers.FPL";

    /* Keys */
    private static function _getFixtureKey(): string {
        return self::CACHE_KEY . "Fixture";
    }

    /* Get */
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
}
