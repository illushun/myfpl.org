<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Season;
use App\Models\LeagueNewsCategory;
use App\Models\LeagueNewsSeason;

class LeagueNews extends Model
{
    use HasFactory;

    protected $table = "league_news";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'season_id',
        'headline',
        'description',
        'link',
        'category_id',
        'hash',
    ];

    public function season(): HasOne {
        return $this->hasOne(Season::class, 'id', 'season_id');        
    }

    public function category() {
        return $this->belongsTo(LeagueNewsCategory::class, 'category_id', 'id');        
    }

    public function images(): HasMany {
        return $this->hasMany(LeagueNewsImage::class, 'post_id', 'id');        
    }
}
