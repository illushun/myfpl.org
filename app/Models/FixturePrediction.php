<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

use App\Models\Fixture;
use App\Models\Gameweek;
use App\Models\Team;

class FixturePrediction extends Model
{
    use HasFactory;

    protected $table = "fixture_prediction";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'gameweek_id',
        'fixture_id',
        'team_id',
        'outcome',
    ];

    public function team(): HasOne {
        return $this->hasOne(Team::class, 'id', 'team_id');
    }

    public function fixture(): HasOne {
        return $this->hasOne(Fixture::class, 'id', 'fixture_id');
    }

    public function gameweek(): HasOne {
        return $this->hasOne(Gameweek::class, 'id', 'gameweek_id');
    }

}
