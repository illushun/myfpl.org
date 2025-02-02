<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use App\Helpers\FPL\Data as FPLData;
use App\Models\FixturePrediction;
use App\Models\PlayerXg;
use App\Models\PlayerStat;
use App\Models\DreamTeam;
use App\Models\LeagueNews;

class IndexComponent extends Component
{
    use WithPagination;

    public $gameweek = null;
    public $gameweekWinningPrediction = null;

    public $highestExpectedGoals = null;
    public $highestExpectedAssists = null;
    public $highestExpectedGoalsPer90 = null;
    public $highestSavesPer90 = null;

    public $highestGoalScorer = null;
    public $highestAssister = null;
    public $highestCleanSheets = null;

    public $dreamTeam = null;
    public $recentNews = null;

    public function render()
    {
        return view('livewire.index-component');
    }

    public function mount() 
    {
        $this->gameweek = FPLData::getCurrentGameweek();

        $this->highestExpectedGoals = PlayerXg
            ::with('player')
                ->select(['expected_goals', 'player_id'])
                ->orderBy('expected_goals', 'desc')
                ->first();
        $this->highestExpectedAssists = PlayerXg
            ::with('player')
                ->select(['expected_assists', 'player_id'])
                ->orderBy('expected_assists', 'desc')
                ->first();
        $this->highestExpectedGoalsPer90 = PlayerXg
            ::with('player')
                ->select(['expected_goals_per_90', 'player_id'])
                ->orderBy('expected_goals_per_90', 'desc')
                ->first();

        $this->highestGoalScorer = PlayerStat
            ::with('player')
                ->select(['goals_scored', 'player_id'])
                ->orderBy('goals_scored', 'desc')
                ->first();
        $this->highestAssister = PlayerStat
            ::with('player')
                ->select(['assists', 'player_id'])
                ->orderBy('assists', 'desc')
                ->first();
        $this->highestCleanSheets = PlayerStat
            ::with('player')
                ->whereHas('player', function ($query) {
                    $query->where('type', 1);
                })
                ->select(['clean_sheets', 'player_id'])
                ->orderBy('clean_sheets', 'desc')
                ->first();

        $this->dreamTeam = DreamTeam
            ::with('player')
                ->select(['points', 'position', 'player_id'])
                ->where('gameweek_id', $this->gameweek->id)
                ->orderBy('position', 'asc')
                ->get();

        $this->recentNews = LeagueNews
            ::with('images')
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();
    }
}
