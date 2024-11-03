<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

use App\Models\Player;
use App\Models\Gameweek;

class PlayerNews extends Model
{
    use HasFactory;

    protected $table = "player_news";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'player_id',
        'gameweek_id',
        'news',
    ];

    public function player(): HasOne {
        return $this->hasOne(Player::class, 'id', 'player_id');
    }

    public function gameweek(): HasOne {
        return $this->hasOne(Gameweek::class, 'id', 'gameweek_id');
    }
}
