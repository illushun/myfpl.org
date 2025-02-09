<?php

namespace App\Livewire\Players;

use Livewire\Component;

use App\Helpers\FPL\Data as FPLData;
use App\Helpers\Chart\Helper as ChartHelper;

class PlayersViewComponent extends Component
{

    public $gs_chart = ''; // goals scored
    public $as_chart = ''; // assists
    public $saves_chart = ''; 

    public function render()
    {
        return view('livewire.players.players-view-component');
    }

    public function mount()
    {
        $this->gameweek = FPLData::getCurrentGameweek();

        $gs_chart_data = ChartHelper::formatTopScorersData($this->gameweek->id);
        $this->gs_chart = ChartHelper::getHorizontalBarTemplate();
        $this->gs_chart = ChartHelper::makeChart(
            $this->gs_chart,
            $gs_chart_data["data"],
            $gs_chart_data["labels"]
        );

        $as_chart_data = ChartHelper::formatTopAssistersData($this->gameweek->id);
        $this->as_chart = ChartHelper::getHorizontalBarTemplate();
        $this->as_chart = ChartHelper::makeChart(
            $this->as_chart,
            $as_chart_data["data"],
            $as_chart_data["labels"]
        );

        $saves_chart_data = ChartHelper::formatMostSavesData($this->gameweek->id);
        $this->saves_chart = ChartHelper::getHorizontalBarTemplate();
        $this->saves_chart = ChartHelper::makeChart(
            $this->saves_chart,
            $saves_chart_data["data"],
            $saves_chart_data["labels"]
        );
    }
}
