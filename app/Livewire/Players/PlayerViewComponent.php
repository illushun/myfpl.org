<?php

namespace App\Livewire\Players;

use Livewire\Component;
use App\Models\Player;
use App\Models\PlayerXg;

use App\Helpers\FPL\Helper as FPLHelper;
use App\Helpers\FPL\Player\Helper as PlayerHelper;
use App\Helpers\Chart\Helper as ChartHelper;

class PlayerViewComponent extends Component
{
    public $player;
    public $stats;

    public $test_chart = '';

    public function mount($data) {
        $this->player = $data;

        dd(PlayerHelper::getPredictedGoalsByGameweek38($this->player->id));
    }

    public function render()
    {
        return view('livewire.players.player-view-component');
    }
}
