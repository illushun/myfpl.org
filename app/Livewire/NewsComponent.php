<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\PlayerNews;

class NewsComponent extends Component
{
    use WithPagination;

    public function mount()
    {
    
    }

    public function render()
    {
        $news = PlayerNews
            ::with('player')
                ->orderBy('created_at', 'desc')
                ->paginate(15);

        return view('livewire.news-component', [
            'news' => $news
        ]);
    }
}
