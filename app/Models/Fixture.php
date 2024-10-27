<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

use App\Models\FixtureStat;
use App\Models\FixturePrediction;
use App\Models\Team;

class Fixture extends Model
{
    use HasFactory;

    protected $table = "fixture";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'fixture_id', // id
        'gameweek_id', // event
        'kickoff_time',
        'minutes',
        'started',
        'finished',
        'finished_provisional',
        'provisional_start_time',
        'team_a',
        'team_a_score',
        'team_a_difficulty',
        'team_h',
        'team_h_score',
        'team_h_difficulty',
    ];

    public function stats(): HasMany {
        return $this->hasMany(FixtureStat::class, 'id', 'id');
    }

    public function awayTeam(): HasOne {
        return $this->hasOne(Team::class, 'id', 'team_a');
    }

    public function homeTeam(): HasOne {
        return $this->hasOne(Team::class, 'id', 'team_h');
    }

    public function prediction(): HasOne {
        return $this->hasOne(FixturePrediction::class, 'fixture_id', 'fixture_id');
    }
}
