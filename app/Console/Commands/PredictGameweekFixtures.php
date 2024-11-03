<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Exception;

use App\Helpers\FPL\Data as FPLData;
use App\Helpers\FPL\Season\SeasonHelper;

use App\Models\Gameweek;
use App\Models\FixturePrediction;

class PredictGameweekFixtures extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fpl:predict-gameweek-fixtures {gameweek?}';

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
        $gameweek = FPLData::getCurrentGameweek()->id;
        if ($this->argument('gameweek')) {
            $gameweek = $this->argument('gameweek');
        }

        $alreadyPredicted = FixturePrediction::where('gameweek_id', $gameweek)->count();
        if ($alreadyPredicted) {
            return;
        }

        $predictions = FPLData::getGameweekPrediction($gameweek);
        foreach ($predictions as $fixture_id => $prediction) {
            foreach ($prediction as $teamType => $data) {
                try {
                    FixturePrediction::insert([
                        "gameweek_id" => $gameweek,
                        "fixture_id" => $fixture_id,
                        "team_id" => $data["team"]->id,
                        "outcome" => $data["outcome"]
                    ]);
                } catch (Exception $e) {
                    \Log::error("[PredictGameweekFixtures] " . $e->getMessage());
                }
            }
        }
    }
}
