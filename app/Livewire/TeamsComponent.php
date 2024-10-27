<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Team;

class TeamsComponent extends Component
{
    use WithPagination;

    public function mount()
    {
    
    }

    public function render()
    {
        $teams = Team::orderBy('id', 'asc')->paginate(9); 
        return view('livewire.teams-component', [
            'teams' => $teams
        ]);
    }
}
