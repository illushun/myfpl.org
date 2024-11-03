<?php

/**
 * Manipulate FPL Data from API
 *
 * Creator: Stuart Davey
 */

namespace App\Helpers\FPL\Team;

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
    private static function _getTeamKey(): string {
        return self::CACHE_KEY . "Team";
    }

    /* Get */
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
}
