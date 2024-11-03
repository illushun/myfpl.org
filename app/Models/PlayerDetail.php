<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

use App\Models\Team;
use App\Models\Player;

class PlayerDetail extends Model
{
    use HasFactory;

    protected $table = "player_detail";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'player_id',
        'code',
        'photo',
        'status',
        'team_id',
    ];

    public function player(): HasOne {
        return $this->hasOne(Player::class, 'id', 'player_id');
    }

    public function team(): HasOne {
        return $this->hasOne(Team::class, 'id', 'team_id');
    }
}
