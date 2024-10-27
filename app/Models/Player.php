<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Team;
use App\Models\PlayerRole;
use App\Models\PlayerStat;
use App\Models\PlayerXg;
use App\Models\PlayerNews;

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
        'code',
        'photo',
        'first_name',
        'second_name',
        'web_name',
        'squad_number',
        'status',
        'team_id',
        'player_type',
        'special',
    ];

    public function team(): HasOne {
        return $this->hasOne(Team::class, 'id', 'team_id');
    }

    public function type(): HasOne {
        return $this->hasOne(PlayerRole::class, 'id', 'player_type');        
    }

    public function stats(): HasOne {
        return $this->hasOne(PlayerStat::class);
    }

    public function xg(): HasOne {
        return $this->hasOne(PlayerXg::class);
    }

    public function fixtureStats(): HasMany {
        return $this->hasMany(FixtureStat::class, 'player_id');
    }

    public function dreamTeams(): HasMany {
        return $this->hasMany(DreamTeam::class, 'player_id', 'fpl_id');
    }
}
