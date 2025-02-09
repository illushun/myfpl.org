<?php

/**
 * Manipulate FPL Data from API
 *
 * Creator: Stuart Davey
 */

namespace App\Helpers\Chart;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

use App\Models\PlayerXg;
use App\Models\PlayerStat;

class Helper {
    protected const CACHE_EXPIRE=86400; // 1 day
    public const CACHE_KEY="App.Helpers.Chart";

    /* Keys */
    private static function _getExpectedGoalsKey(): string {
        return self::CACHE_KEY . ".ExpectedGoals";
    }

    private static function _getExpectedAssistsKey(): string {
        return self::CACHE_KEY . ".ExpectedAssists";
    }

    private static function _getExpectedGoalInvolvementsKey(): string {
        return self::CACHE_KEY . ".ExpectedGoalInvolvements";
    }

    private static function _getExpectedGoalsPer90Key(): string {
        return self::CACHE_KEY . ".ExpectedGoalsPer90";
    }

    private static function _getTopScorersKey(): string {
        return self::CACHE_KEY . ".TopScorers";
    }

    private static function _getTopAssistersKey(): string {
        return self::CACHE_KEY . ".TopAssisters";
    }

    private static function _getMostSavesKey(): string {
        return self::CACHE_KEY . ".MostSaves";
    }

    /* Get */
    public static function getRadarTemplate(): string {
        return '
            chart: {
                height: 300,
                type: "radar",
                toolbar: {
                    show: false,
                }
            },
            colors: [%COLOURS%],
            series: [%SERIES%],
        ';
    }

    public static function getDistributedColumnTemplate(): string {
        return '
            chart: {
                height: 300,
                type: "bar",
                toolbar: {
                    show: false,
                },
            },
            colors: [%COLOURS%],
            series: [%SERIES%],
            xaxis: {
                categories: [%LABELS%],
                labels: {
                    style: {
                        colors: [%COLOURS%],
                        fontSize: "12px"
                    }
                }
            },
            yaxis: {
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    borderRadius: 5,
                    columnWidth: "65%",
                    distributed: true,
                    dataLabels: {
                        position: "top",
                    }
                }
            },
            dataLabels: {
                enabled: true
            },
            legend: {
                show: false
            }
        ';
    }

    public static function getHorizontalBarTemplate(): string {
        return '
            chart: {
                height: 350,
                type: "bar",
                toolbar: {
                    show: false,
                },
            },
            colors: [%COLOURS%],
            series: [%SERIES%],
            xaxis: {
                categories: [%LABELS%],
                labels: {
                    style: {
                        colors: [%COLOURS%],
                        fontSize: "12px"
                    }
                }
            },
            plotOptions: {
                bar: {
                    borderRadius: 5,
                    borderRadiusApplication: "end",
                    horizontal: true,
                    distributed: true,
                }
            },
            dataLabels: {
                enabled: true
            },
            legend: {
                show: false
            }
        ';
    }

    public static function getChartTemplate(): string {
        return '
            chart: {
                height: 300,
                type: %CHART_TYPE%,
                toolbar: {
                    show: false,
                }
            }
        ';
    }

    public static function makeChart(
        string $template,
        string $data,
        array $labels,
        array $colours = [
            "#64A9D9",
            "#306E9A",
            "#243F52",
        ],
    ): string {
        // used for mapping and replacing
        // with data in the template
        $keys = array(
            "%SERIES%",
            "%COLOURS%",
            "%LABELS%"
        );

        $replace = array(
            $data,
            '"' . implode('","', $colours) . '"',
            '"' . implode('","', $labels) . '"'
        );
        
        return str_replace($keys, $replace, $template);
    }

    public static function formatExpectedGoalsData($gameweek_id): array {
        $cacheKey = self::_getExpectedGoalsKey();
        return Cache::remember($cacheKey, self::CACHE_EXPIRE, function () use ($gameweek_id) {
            $return = [];

            $xg_data = [];
            $xg_records = PlayerXg
                ::with('player')
                    ->select(['expected_goals', 'player_id'])
                    ->where('gameweek_id', $gameweek_id)
                    ->orderBy('expected_goals', 'desc')
                    ->take(4)
                    ->get();

            foreach ($xg_records as $record) {
                $xg_data["labels"][] = $record->player->second_name;
                $xg_data["data"][] = (float)$record->expected_goals;
            }
            $xg_data["data"] = str_replace(['[', ']'], '', json_encode($xg_data["data"]));

            $return["data"] = "
                {
                    data: [{$xg_data['data']}],
                }
            ";
            $return["labels"] = $xg_data["labels"];

            return $return;
        });
    }

    public static function formatExpectedAssistsData($gameweek_id): array {
        $cacheKey = self::_getExpectedAssistsKey();
        return Cache::remember($cacheKey, self::CACHE_EXPIRE, function () use ($gameweek_id) {
            $return = [];

            $xa_data = [];
            $xa_records = PlayerXg
                ::with('player')
                    ->select(['expected_assists', 'player_id'])
                    ->where('gameweek_id', $gameweek_id)
                    ->orderBy('expected_assists', 'desc')
                    ->take(4)
                    ->get();

            foreach ($xa_records as $record) {
                $xa_data["labels"][] = $record->player->second_name;
                $xa_data["data"][] = (float)$record->expected_assists;
            }
            $xa_data["data"] = str_replace(['[', ']'], '', json_encode($xa_data["data"]));

            $return["data"] = "
                {
                    data: [{$xa_data['data']}],
                }
            ";
            $return["labels"] = $xa_data["labels"];

            return $return;
        });
    }

    public static function formatExpectedGoalInvolvementsData($gameweek_id): array {
        $cacheKey = self::_getExpectedGoalInvolvementsKey();
        return Cache::remember($cacheKey, self::CACHE_EXPIRE, function () use ($gameweek_id) {
            $return = [];

            $xgp_data = [];
            $xgp_records = PlayerXg
                ::with('player')
                    ->select(['expected_goal_involvements', 'player_id'])
                    ->where('gameweek_id', $gameweek_id)
                    ->orderBy('expected_goal_involvements', 'desc')
                    ->take(4)
                    ->get();

            foreach ($xgp_records as $record) {
                $xgp_data["labels"][] = $record->player->second_name;
                $xgp_data["data"][] = (float)$record->expected_goal_involvements;
            }
            $xgp_data["data"] = str_replace(['[', ']'], '', json_encode($xgp_data["data"]));

            $return["data"] = "
                {
                    data: [{$xgp_data['data']}],
                }
            ";
            $return["labels"] = $xgp_data["labels"];

            return $return;
        });
    }

    public static function formatExpectedGoalsPer90Data($gameweek_id): array {
        $cacheKey = self::_getExpectedGoalsPer90Key();
        return Cache::remember($cacheKey, self::CACHE_EXPIRE, function () use ($gameweek_id) {
            $return = [];

            $xgp_data = [];
            $xgp_records = PlayerXg
                ::with('player')
                    ->select(['expected_goals_per_90', 'player_id'])
                    ->where('gameweek_id', $gameweek_id)
                    ->orderBy('expected_goals_per_90', 'desc')
                    ->take(4)
                    ->get();

            foreach ($xgp_records as $record) {
                $xgp_data["labels"][] = $record->player->second_name;
                $xgp_data["data"][] = (float)$record->expected_goals_per_90;
            }
            $xgp_data["data"] = str_replace(['[', ']'], '', json_encode($xgp_data["data"]));

            $return["data"] = "
                {
                    data: [{$xgp_data['data']}],
                }
            ";
            $return["labels"] = $xgp_data["labels"];

            return $return;
        });
    }

    public static function formatTopScorersData($gameweek_id): array {
        $cacheKey = self::_getTopScorersKey();
        return Cache::remember($cacheKey, self::CACHE_EXPIRE, function () use ($gameweek_id) {
            $return = [];

            $gs_data = [];
            $gs_records = PlayerStat
                ::with('player')
                    ->select(['goals_scored', 'player_id'])
                    ->where('gameweek_id', $gameweek_id)
                    ->orderBy('goals_scored', 'desc')
                    ->take(10)
                    ->get();

            foreach ($gs_records as $record) {
                $xg_record = PlayerXg
                    ::with('player')
                        ->select(['expected_goals', 'player_id'])
                        ->where('player_id', $record->player->id)
                        ->first();

                $gs_data[$record->player->web_name]["data"]["actual"] = (int)$record->goals_scored;
                $gs_data[$record->player->web_name]["data"]["expected"] = (float)$xg_record->expected_goals;
            }

            $return["data"] = '{
                name: "Goals",
                data: [
            ';
            foreach ($gs_data as $name => $data) {
                $data = $data["data"];

                $return["data"] .= '{';
                $return["data"] .= 'x: "' . $name . '",';
                $return["data"] .= 'y: ' . $data["actual"] . ',';
                $return["data"] .= 'goals: [{';
                $return["data"] .= 'name: "XG",';
                $return["data"] .= 'value: ' . $data["expected"] . ',';
                $return["data"] .= 'strokeWidth: 5,';
                $return["data"] .= 'strokeHeight: 10,';
                $return["data"] .= 'strokeColor: "#4DD37C",';
                $return["data"] .= '}]';
                $return["data"] .= '},';

                $return["labels"][] = $name;
            }
            $return["data"] .= '],}';

            return $return;
        });
    }

    public static function formatTopAssistersData($gameweek_id): array {
        $cacheKey = self::_getTopAssistersKey();
        return Cache::remember($cacheKey, self::CACHE_EXPIRE, function () use ($gameweek_id) {
            $return = [];

            $as_data = [];
            $as_records = PlayerStat
                ::with('player')
                    ->select(['assists', 'player_id'])
                    ->where('gameweek_id', $gameweek_id)
                    ->orderBy('assists', 'desc')
                    ->take(10)
                    ->get();

            foreach ($as_records as $record) {
                $xg_record = PlayerXg
                    ::with('player')
                        ->select(['expected_assists', 'player_id'])
                        ->where('player_id', $record->player->id)
                        ->first();

                $as_data[$record->player->web_name]["data"]["actual"] = (int)$record->assists;
                $as_data[$record->player->web_name]["data"]["expected"] = (float)$xg_record->expected_assists;
            }

            $return["data"] = '{
                name: "Assists",
                data: [
            ';
            foreach ($as_data as $name => $data) {
                $data = $data["data"];

                $return["data"] .= '{';
                $return["data"] .= 'x: "' . $name . '",';
                $return["data"] .= 'y: ' . $data["actual"] . ',';
                $return["data"] .= 'goals: [{';
                $return["data"] .= 'name: "XA",';
                $return["data"] .= 'value: ' . $data["expected"] . ',';
                $return["data"] .= 'strokeWidth: 5,';
                $return["data"] .= 'strokeHeight: 10,';
                $return["data"] .= 'strokeColor: "#4DD37C",';
                $return["data"] .= '}]';
                $return["data"] .= '},';

                $return["labels"][] = $name;
            }
            $return["data"] .= '],}';

            return $return;
        });
    }

    public static function formatMostSavesData($gameweek_id): array {
        $cacheKey = self::_getMostSavesKey();
        return Cache::remember($cacheKey, self::CACHE_EXPIRE, function () use ($gameweek_id) {
            $return = [];

            $saves_data = [];
            $saves_records = PlayerStat
                ::with('player')
                    ->select(['saves', 'player_id'])
                    ->where('gameweek_id', $gameweek_id)
                    ->orderBy('saves', 'desc')
                    ->take(10)
                    ->get();

            foreach ($saves_records as $record) {
                $saves_data["labels"][] = $record->player->web_name;
                $saves_data["data"][] = (int)$record->saves;
            }
            $saves_data["data"] = str_replace(['[', ']'], '', json_encode($saves_data["data"]));

            $return["data"] = "
                {
                    data: [{$saves_data['data']}],
                }
            ";
            $return["labels"] = $saves_data["labels"];

            return $return;
        });
    }
}
