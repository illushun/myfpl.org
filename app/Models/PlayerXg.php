<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

use App\Models\Player;

class PlayerXg extends Model
{
    use HasFactory;

    protected $table = "player_xg";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'player_id',
        'expected_goals',
        'expected_assists',
        'expected_goal_involvements',
        'expected_goals_conceded',
        'expected_goals_per_90',
        'saves_per_90',
        'expected_assists_per_90',
        'expected_goal_involvements_per_90',
        'expected_goals_conceded_per_90',
        'goals_conceded_per_90',
        'starts_per_90',
        'clean_sheets_per_90',
    ];

    public function player(): HasOne {
        return $this->hasOne(Player::class, 'id', 'player_id');
    }

}
