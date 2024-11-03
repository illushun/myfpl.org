<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

use App\Models\Fixture;
use App\Models\Season;

class Gameweek extends Model
{
    use HasFactory;

    protected $table = "gameweek";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fpl_id',
        'season_id',
        'name',
        'deadline',
        'deadline_offset',
        'is_previous',
        'is_current',
        'is_next',
    ];

    public function season(): HasOne {
        return $this->hasOne(Season::class, 'id', 'season_id');        
    }

    public function fixtures(): HasMany {
        return $this->hasMany(Fixture::class, 'gameweek_id');
    }
}
