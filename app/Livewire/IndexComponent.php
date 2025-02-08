<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use App\Helpers\FPL\Data as FPLData;
use App\Helpers\Chart\Helper as ChartHelper;

use App\Models\FixturePrediction;
use App\Models\PlayerXg;
use App\Models\PlayerStat;
use App\Models\DreamTeam;
use App\Models\LeagueNews;

class IndexComponent extends Component
{
    use WithPagination;

    public $xg_chart = '';
    public $xa_chart = '';
    public $gi_chart = '';

    public $gameweek = null;
    public $gameweekWinningPrediction = null;

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

        $xg_chart_data = ChartHelper::formatExpectedGoalsData($this->gameweek->id);
        $this->xg_chart = ChartHelper::getDistributedColumnTemplate();
        $this->xg_chart = ChartHelper::makeChart(
            $this->xg_chart,
            $xg_chart_data["data"],
            ['#002c5a', '#e32118', '#3498db'],
            $xg_chart_data["labels"]
        );

        $xa_chart_data = ChartHelper::formatExpectedAssistsData($this->gameweek->id);
        $this->xa_chart = ChartHelper::getDistributedColumnTemplate();
        $this->xa_chart = ChartHelper::makeChart(
            $this->xa_chart,
            $xa_chart_data["data"],
            ['#002c5a', '#e32118', '#3498db'],
            $xa_chart_data["labels"]
        );

        $gi_chart_data = ChartHelper::formatExpectedGoalInvolvementsData($this->gameweek->id);
        $this->gi_chart = ChartHelper::getDistributedColumnTemplate();
        $this->gi_chart = ChartHelper::makeChart(
            $this->gi_chart,
            $gi_chart_data["data"],
            ['#002c5a', '#e32118', '#3498db'],
            $gi_chart_data["labels"]
        );

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
