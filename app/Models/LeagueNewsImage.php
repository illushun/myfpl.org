<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\LeagueNews;

class LeagueNewsImage extends Model
{
    use HasFactory;

    protected $table = "league_news_image";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'post_id',
        'link',
        'sort',
    ];

    public function post() {
        return $this->belongsTo(LeagueNews::class, 'post_id', 'id');        
    }
}
