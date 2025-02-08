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

class Helper {
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
            },
            toolbar: {
                show: false,
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
                    columnWidth: "45%",
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
        array $colours,
        array $labels
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

    public static function formatExpectedGoalsData(): array {
        $return = [];

        $xg_data = [];
        $xg_records = PlayerXg
            ::with('player')
                ->select(['expected_goals', 'player_id'])
                ->orderBy('expected_goals', 'desc')
                ->take(3)
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
    }

    public static function formatExpectedAssistsData(): array {
        $return = [];

        $xa_data = [];
        $xa_records = PlayerXg
            ::with('player')
                ->select(['expected_assists', 'player_id'])
                ->orderBy('expected_assists', 'desc')
                ->take(3)
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
    }

    public static function formatExpectedGoalsPer90Data(): array {
        $return = [];

        $xgp_data = [];
        $xgp_records = PlayerXg
            ::with('player')
                ->select(['expected_goals_per_90', 'player_id'])
                ->orderBy('expected_goals_per_90', 'desc')
                ->take(3)
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
    }
}
