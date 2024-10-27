<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use App\Helpers\FPL\Data as FPLData;
use App\Models\FixturePrediction;
use App\Models\PlayerXg;
use App\Models\PlayerStat;
use App\Models\DreamTeam;

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

    public function render()
    {
        $teams = FPLData::getTopTeams();
        $players = FPLData::getTopPlayers();
        return view('livewire.index-component', compact('teams', 'players'));
    }

    public function mount() 
    {
        $this->gameweek = FPLData::getCurrentGameweek();

        $this->highestExpectedGoals = PlayerXg
            ::select(['player_xg.expected_goals', 'p.web_name'])
                ->join('player as p', 'player_xg.player_id', '=', 'p.id')
                ->orderBy('player_xg.expected_goals', 'desc')
                ->first();
        $this->highestExpectedAssists = PlayerXg
            ::select(['player_xg.expected_assists', 'p.web_name'])
                ->join('player as p', 'player_xg.player_id', '=', 'p.id')
                ->orderBy('player_xg.expected_assists', 'desc')
                ->first();
        $this->highestExpectedGoalsPer90 = PlayerXg
            ::select(['player_xg.expected_goals_per_90', 'p.web_name'])
                ->join('player as p', 'player_xg.player_id', '=', 'p.id')
                ->orderBy('player_xg.expected_goals_per_90', 'desc')
                ->first();
        $this->highestSavesPer90 = PlayerXg
            ::select(['player_xg.saves_per_90', 'p.web_name'])
                ->join('player as p', 'player_xg.player_id', '=', 'p.id')
                ->orderBy('player_xg.saves_per_90', 'desc')
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
                    $query->where('player_type', 1);
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
    }
}
