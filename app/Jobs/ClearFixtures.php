<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Helpers\FPL\Helper as FPLHelper;
use App\Models\Fixture;
use App\Models\FixtureStat;

class ClearFixtures implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $fixtures = FPLHelper::getFPLFixtures();
        $validFixtures = isset($fixtures[0]);

        if (!$validFixtures) {
            print_r("invalid fixtures\n");
            return;
        }

        FixtureStat::truncate();
        Fixture::truncate();

        foreach ($fixtures as $index => $fixture) {
            $hash = md5(json_encode($fixture));
            $fixtureId = Fixture::insertGetId([
                "code" => $fixture["code"],
                "fixture_id" => $fixture["id"],
                "gameweek_id" => $fixture["event"],
                "kickoff_time" => $fixture["kickoff_time"],
                "minutes" => $fixture["minutes"],
                "started" => $fixture["started"] ? 'true' : 'false',
                "finished" => $fixture["finished"] ? 'true' : 'false',
                "finished_provisional" => $fixture["finished_provisional"] ? 'true' : 'false',
                "provisional_start_time" => $fixture["provisional_start_time"] ? 'true' : 'false',
                "team_a" => $fixture["team_a"],
                "team_a_score" => $fixture["team_a_score"],
                "team_a_difficulty" => $fixture["team_a_difficulty"],
                "team_h" => $fixture["team_h"],
                "team_h_score" => $fixture["team_h_score"],
                "team_h_difficulty" => $fixture["team_h_difficulty"],
            ]);
            
            $validFixtures = isset($fixture["stats"]);
            if (!$validFixtures) {
                continue;
            }

            foreach ($fixture["stats"] as $index => $stat) {
                $awayStats = $stat["a"];
                $homeStats = $stat["h"];

                foreach ($awayStats as $awayStatIndex => $awayStat) {
                    FixtureStat::insert([
                        "fixture_id" => $fixtureId,
                        "identifier" => $stat["identifier"],
                        "team_type" => "a",
                        "value" => $awayStat["value"],
                        "player_id" => $awayStat["element"],
                    ]);
                }

                foreach ($homeStats as $homeStatIndex => $homeStat) {
                    FixtureStat::insert([
                        "fixture_id" => $fixtureId,
                        "identifier" => $stat["identifier"],
                        "team_type" => "h",
                        "value" => $homeStat["value"],
                        "player_id" => $homeStat["element"],
                    ]);
                }
            }
        } 

        print_r("Done fixture inserts!\n");
    }
}
