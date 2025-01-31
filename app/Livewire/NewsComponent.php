<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Helpers\FPL\Helper as FPLHelper;

use App\Models\LeagueNews;

class NewsComponent extends Component
{
    use WithPagination;
    //protected $paginationTheme = 'tailwind';

    public function mount()
    {
        //$this->league_news = FPLHelper::getPLNewsFeed(300); 
    }

    public function render()
    {
        $league_news = LeagueNews
            ::with('images')
                ->orderBy('created_at', 'desc')
                ->paginate(15);

        return view('livewire.news-component', [
            'league_news' => $league_news
        ]);
    }
}
