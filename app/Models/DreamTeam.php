<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

use App\Models\Player;
use App\Models\Gameweek;

class DreamTeam extends Model
{
    use HasFactory;

    protected $table = "dream_team";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'gameweek_id',
        'player_id',
        'points',
        'position'
    ];

    public function player(): HasOne {
        return $this->hasOne(Player::class, 'fpl_id', 'player_id');
    }

    public function gameweek(): HasOne {
        return $this->hasOne(Gameweek::class, 'id', 'gameweek_id');
    }
}
