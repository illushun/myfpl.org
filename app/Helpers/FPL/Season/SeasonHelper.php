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

use App\Models\Season;

class SeasonHelper {

    protected const CACHE_EXPIRE=86400; // 1 day 
    public const CACHE_KEY="App.Helpers.FPL.Season";

    /* Private */
    private static function getSeasonName(): string {
       $currentYear = date("Y");
       $currentMonth = date("n");

        // If current month is June or later, we're in the next season's start year
        if ($currentMonth >= 6) {
            $startYear = $currentYear;
            $endYear = $currentYear + 1;
        } else {
            // If we're before June, we're still in the previous season's end year
            $startYear = $currentYear - 1;
            $endYear = $currentYear;
        }

        return "{$startYear}/{$endYear}"; 
    }

    /* Get */
    public static function getCurrentSeason(): mixed {
        $cacheKey = self::CACHE_KEY;
        return Cache::remember($cacheKey, self::CACHE_EXPIRE, function () {
            $currentSeasonName = self::getSeasonName();

            $season = Season::where('name', $currentSeasonName)->first();
            if (!$season) {
                $seasonId = Season::insertGetId([
                    'name' => $currentSeasonName
                ]);
                $season = Season::where('id', $seasonId)->first();
            }
            return $season;
       });
    }
}
