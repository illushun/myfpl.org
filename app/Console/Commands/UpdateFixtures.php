<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Exception;

use App\Helpers\FPL\Helper as FPLHelper;
use App\Models\Fixture;
use App\Models\FixtureStat;

class UpdateFixtures extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fpl:update-fixtures';

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
        $fixtures = FPLHelper::getFPLFixtures();
        $validFixtures = isset($fixtures[0]);

        if (!$validFixtures) {
            \Log::info("[UpdateFixtures] Invalid fixtures!");
            return;
        }

        foreach ($fixtures as $index => $fixture) {
            $FPLFixture = Fixture::where('fixture_id', $fixture["id"])->first();
            if (!$FPLFixture) {
                \Log::info("[UpdateFixtures] Unable to find fixture ID: " . $fixture["id"]);
                continue;
            }

            $hash = md5(json_encode($fixture));
            if ($hash === $FPLFixture->hash) {
                continue;
            }

            try {
                $FPLFixture->minutes = $fixture["minutes"];
                $FPLFixture->started = $fixture["started"] ? 'true' : 'false';
                $FPLFixture->finished = $fixture["finished"] ? 'true' : 'false';
                $FPLFixture->finished_provisional = $fixture["finished_provisional"] ? 'true' : 'false';
                $FPLFixture->provisional_start_time = $fixture["provisional_start_time"] ? 'true' : 'false';
                $FPLFixture->team_a_score = $fixture["team_a_score"];
                $FPLFixture->team_h_score = $fixture["team_h_score"];
            } catch (Exception $e) {
                \Log::error("[UpdateFixtures] FPLFixture: " . $e->getMessage());
            }

            $validStats = isset($fixture["stats"]);
            if (!$validStats) {
                continue;
            }

            foreach ($fixture["stats"] as $index => $stat) {
                $awayStats = $stat["a"];
                $homeStats = $stat["h"];

                foreach ($awayStats as $awayStatIndex => $awayStat) {
                    $validStat = FixtureStat
                        ::where('fixture_id', $FPLFixture->id)
                            ->where('identifier', $stat["identifier"])
                            ->where('team_type', "a")
                            ->where('value', $awayStat["value"])
                            ->where('player_id', $awayStat["element"])
                            ->first();

                    if ($validStat) {
                        continue;
                    }

                    try {
                        FixtureStat::insert([
                            "fixture_id" => $FPLFixture->id,
                            "identifier" => $stat["identifier"],
                            "team_type" => "a",
                            "value" => $awayStat["value"],
                            "player_id" => $awayStat["element"],
                        ]);
                    } catch (Exception $e) {
                        \Log::error("[UpdateFixtures] FixtureStatAway: " . $e->getMessage());
                    }
                }

                foreach ($homeStats as $homeStatIndex => $homeStat) {
                    $validStat = FixtureStat
                        ::where('fixture_id', $FPLFixture->id)
                            ->where('identifier', $stat["identifier"])
                            ->where('team_type', "h")
                            ->where('value', $homeStat["value"])
                            ->where('player_id', $homeStat["element"])
                            ->first();

                    if ($validStat) {
                        continue;
                    }

                    try {
                        FixtureStat::insert([
                            "fixture_id" => $FPLFixture->id,
                            "identifier" => $stat["identifier"],
                            "team_type" => "h",
                            "value" => $homeStat["value"],
                            "player_id" => $homeStat["element"],
                        ]);
                    } catch (Exception $e) {
                        \Log::error("[UpdateFixtures] FixtureStatHome: " . $e->getMessage());
                    }
                }
            }
        } 
    }
}