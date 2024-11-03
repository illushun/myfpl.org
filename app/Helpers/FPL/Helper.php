<?php

/**
 * FPL Helper
 *
 * Creator: Stuart Davey
 */

namespace App\Helpers\FPL;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Exception;

class Helper {
    
    protected const CACHE_EXPIRE=3600; // 1 hour
    protected const SEASON_EXPIRE=60; 
    protected const FIXTURE_EXPIRE=60;
    protected const DREAM_TEAM_EXPIRE=60;
    public const CACHE_KEY="App.Helpers.FPL";

    /* Keys */
    private static function _getSummaryKey(): string {
        return self::CACHE_KEY . ".Summary";
    }

    private static function _getSeasonKey(): string {
        return self::CACHE_KEY . ".Season";
    }

    private static function _getFixtureKey(): string {
        return self::CACHE_KEY . ".Fixture";
    }

    private static function _getDreamTeamKey(): string {
        return self::CACHE_KEY . ".DreamTeam";
    }

    /* Get */
    public static function getFPLSummary(): mixed {
        $cacheKey = self::_getSummaryKey();
        return Cache::remember($cacheKey, self::CACHE_EXPIRE, function () {
            try {
                $apiUrl = env("API_URL") . env("FPL_SUMMARY");
                $response = Http::get($apiUrl);
            } catch (Exception $e) {
                \Log::error("[FPLHelper] GetFPLSummary: " . $e->getMessage());
                return [];
            }
            return $response->ok() ? $response->json() : [];
        });
    }

    public static function getCurrentSeason(): string {
        $cacheKey = self::_getSeasonKey();
        return Cache::remember($cacheKey, self::SEASON_EXPIRE, function () {
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
        });
    }

    public static function getFPLLiveFixtures(int $gameweek_id): mixed {
        $cacheKey = self::_getFixtureKey() . "." . $gameweek_id;
        return Cache::remember($cacheKey, self::FIXTURE_EXPIRE, function () use ($gameweek_id) {
            try {
                $apiUrl = env("API_URL") . str_replace("%EVENT_ID%", $gameweek_id, env("FPL_FIXTURE_EVENT"));
                $response = Http::get($apiUrl);
            } catch (Exception $e) {
                \Log::error("[FPLHelper] GetFPLLiveFixtures: " . $e->getMessage());
                return [];
            }
            return $response->ok() ? $response->json() : [];
        });
    }

    public static function getFPLFixtures(): mixed {
        $cacheKey = self::_getFixtureKey();
        return Cache::remember($cacheKey, self::FIXTURE_EXPIRE, function () {
            try {
                $apiUrl = env("API_URL") . env("FPL_FIXTURES");
                $response = Http::get($apiUrl);
            } catch (Exception $e) {
                \Log::error("[FPLHelper] GetFPLFixtures: " . $e->getMessage());
                return [];
            }
            return $response->ok() ? $response->json() : [];
        });
    }

    public static function getDreamTeam(int $gameweek_id): mixed {
        $cacheKey = self::_getDreamTeamKey() . "." . $gameweek_id;
        return Cache::remember($cacheKey, self::DREAM_TEAM_EXPIRE, function () use ($gameweek_id) {
            try {
                $apiUrl = env("API_URL") . str_replace("%EVENT_ID%", $gameweek_id, env("FPL_DREAM_TEAM")); 
                $response = Http::get($apiUrl);
            } catch (Exception $e) {
                \Log::error("[FPLHelper] GetDreamTeam: " . $e->getMessage());
                return [];
            }
            return $response->ok() ? $response->json() : [];
        });
    }


    /* Forget */
    public static function forgetFPLSummary(): void {
        $cacheKey = self::_getSummaryKey();
        Cache::forget($cacheKey);
    }
}
