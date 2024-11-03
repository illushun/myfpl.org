<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

use App\Models\Player;
use App\Models\Gameweek;

class PlayerStat extends Model
{
    use HasFactory;

    protected $table = "player_stat";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'player_id',
        'gameweek_id',
        'now_cost',
        'points_per_game',
        'selected_by_percent',
        'total_points',
        'form',
        'value_form',
        'value_season',
        'minutes',
        'goals_scored',
        'assists',
        'clean_sheets',
        'goals_conceded',
        'own_goals',
        'penalties_saved',
        'penalties_missed',
        'yellow_cards',
        'red_cards',
        'saves',
        'bonus',
        'bps',
        'influence',
        'creativity',
        'threat',
        'starts',
    ];

    public function player(): HasOne {
        return $this->hasOne(Player::class, 'id', 'player_id');
    }

    public function gameweek(): HasOne {
        return $this->hasOne(Gameweek::class, 'id', 'gameweek_id');
    }
}
