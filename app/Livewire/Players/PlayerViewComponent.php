<?php

namespace App\Livewire\Players;

use Livewire\Component;

class PlayerViewComponent extends Component
{
    public $player;

    public function mount($data) {
        $this->player = $data;
    }

    public function render()
    {
        return view('livewire.players.player-view-component');
    }
}
