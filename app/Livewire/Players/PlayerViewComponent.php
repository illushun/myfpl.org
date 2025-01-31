<?php

namespace App\Livewire\Players;

use Livewire\Component;
use App\Models\Player;
use App\Helpers\FPL\Helper as FPLHelper;

class PlayerViewComponent extends Component
{
    public $player;
    public $stats;

    public function mount($data) {
        $this->player = $data;
    }

    public function render()
    {
        return view('livewire.players.player-view-component');
    }
}
