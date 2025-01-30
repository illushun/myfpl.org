<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\LeagueNews;

class LeagueNewsCategory extends Model
{
    use HasFactory;

    protected $table = "league_news_category";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'origin_category_id',
        'name',
        'type',
    ];

    public function posts(): HasMany {
        return $this->hasMany(LeagueNews::class, 'category_id', 'id');        
    }
}
