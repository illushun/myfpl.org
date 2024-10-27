<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

use App\Models\Fixture;
use App\Models\FixtureStat;
use App\Models\TeamStrength;

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

    public function strengthStats(): HasOne {
        return $this->hasOne(TeamStrength::class);
    }

    public function awayFixtures(): HasMany {
        return $this->hasMany(Fixture::class, 'team_a');
    }

    public function homeFixtures(): HasMany {
        return $this->hasMany(Fixture::class, 'team_h');
    }
}
