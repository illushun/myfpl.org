<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Helpers\FPL\Helper as FPLHelper;
use App\Helpers\FPL\Season\SeasonHelper;

use App\Models\Fixture;
use App\Models\FixtureStat;
use App\Models\Team;
use App\Models\Gameweek;
use App\Models\Player;

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

        $season = SeasonHelper::getCurrentSeason();
        if (!$season) {
            print_r("Unable to get current season\n");
            return;
        }

        //FixtureStat::truncate();
        //Fixture::truncate();

        foreach ($fixtures as $index => $fixture) {
            $hash = md5(json_encode($fixture));
            $gameweek = Gameweek
                ::where('season_id', $season->id)
                    ->where('fpl_id', $fixture["event"])
                    ->first();

            if (!$gameweek) {
                continue;
            }

            Fixture::where('gameweek_id', $gameweek->id)->delete();

            $teamA = Team
                ::where('season_id', $season->id)
                    ->where('fpl_id', $fixture["team_a"])
                    ->first();

            if (!$teamA) {
                continue;
            }

            $teamH = Team
                ::where('season_id', $season->id)
                    ->where('fpl_id', $fixture["team_h"])
                    ->first();

            if (!$teamH) {
                continue;
            }

            $fixtureId = Fixture::insertGetId([
                "code" => $fixture["code"],
                "fixture_id" => $fixture["id"],
                "gameweek_id" => $gameweek->id,
                "kickoff_time" => $fixture["kickoff_time"],
                "minutes" => $fixture["minutes"],
                "started" => $fixture["started"] ? 'true' : 'false',
                "finished" => $fixture["finished"] ? 'true' : 'false',
                "finished_provisional" => $fixture["finished_provisional"] ? 'true' : 'false',
                "provisional_start_time" => $fixture["provisional_start_time"] ? 'true' : 'false',
                "team_a" => $teamA->id,
                "team_a_score" => $fixture["team_a_score"],
                "team_a_difficulty" => $fixture["team_a_difficulty"],
                "team_h" => $teamH->id,
                "team_h_score" => $fixture["team_h_score"],
                "team_h_difficulty" => $fixture["team_h_difficulty"],
                "hash" => $hash,
            ]);
            
            $validFixtures = isset($fixture["stats"]);
            if (!$validFixtures) {
                continue;
            }

            foreach ($fixture["stats"] as $index => $stat) {
                $awayStats = $stat["a"];
                $homeStats = $stat["h"];

                foreach ($awayStats as $awayStatIndex => $awayStat) {
                    $player = Player
                        ::where('season_id', $season->id)
                            ->where('fpl_id', $awayStat["element"])
                            ->first();

                    if (!$player) {
                        continue;
                    }

                    FixtureStat::insert([
                        "fixture_id" => $fixtureId,
                        "identifier" => $stat["identifier"],
                        "team_type" => "a",
                        "value" => $awayStat["value"],
                        "player_id" => $player->id,
                    ]);
                }

                foreach ($homeStats as $homeStatIndex => $homeStat) {
                    $player = Player
                        ::where('season_id', $season->id)
                            ->where('fpl_id', $homeStat["element"])
                            ->first();

                    if (!$player) {
                        continue;
                    }

                    FixtureStat::insert([
                        "fixture_id" => $fixtureId,
                        "identifier" => $stat["identifier"],
                        "team_type" => "h",
                        "value" => $homeStat["value"],
                        "player_id" => $player->id,
                    ]);
                }
            }
        } 

        print_r("Done fixture inserts!\n");
    }
}
