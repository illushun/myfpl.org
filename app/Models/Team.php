<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

use App\Models\Fixture;
use App\Models\Season;
use App\Models\FixtureStat;
use App\Models\TeamStrength;
use App\Models\PlayerDetail;

class Team extends Model
{
    use HasFactory;

    protected $table = "team";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fpl_id',
        'season_id',
        'name',
        'short_name',
        'team_division',
        'win',
        'draw',
        'loss',
        'played',
        'position',
        'points',
        'form',
        'strength',
        'code',
        'pulse_id',
        'unavailable'
    ];

    public function season(): HasOne {
        return $this->hasOne(Season::class);
    }

    public function strengthStats(): HasOne {
        return $this->hasOne(TeamStrength::class);
    }

    public function awayFixtures(): HasMany {
        return $this->hasMany(Fixture::class, 'team_a');
    }

    public function homeFixtures(): HasMany {
        return $this->hasMany(Fixture::class, 'team_h');
    }

    public function players(): HasMany {
        return $this->hasMany(PlayerDetail::class, 'team_id');
    }

    public function playerCount(): int {
        return $this->players()->count(); 
    }
}
