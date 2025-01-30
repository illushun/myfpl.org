<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Team;
use App\Models\PlayerType;
use App\Models\PlayerStat;
use App\Models\PlayerXg;
use App\Models\PlayerNews;
use App\Models\PlayerDetail;
use App\Models\Season;

class Player extends Model
{
    use HasFactory;

    protected $table = "player";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fpl_id',
        'season_id',
        'first_name',
        'second_name',
        'web_name',
        'type',
    ];

    public function season(): HasOne {
        return $this->hasOne(Season::class, 'id', 'season_id');        
    }

    public function detail(): HasOne {
        return $this->hasOne(PlayerDetail::class, 'player_id');        
    }

    public function role(): HasOne {
        return $this->hasOne(PlayerType::class, 'id', 'type');        
    }

    public function stats(): HasMany {
        return $this->hasMany(PlayerStat::class, 'player_id');
    }

    public function xg(): HasMany {
        return $this->hasMany(PlayerXg::class);
    }

    public function fixtureStats(): HasMany {
        return $this->hasMany(FixtureStat::class, 'player_id');
    }

    public function dreamTeams(): HasMany {
        return $this->hasMany(DreamTeam::class, 'player_id');
    }
}
