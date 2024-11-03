<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

use App\Models\Team;

class TeamStrength extends Model
{
    use HasFactory;

    protected $table = "team_strength";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'team_id',
        'strength_overall_home',
        'strength_overall_away',
        'strength_attack_home',
        'strength_attack_away',
        'strength_defence_home',
        'strength_defence_away',
    ];

    public function team(): HasOne {
        return $this->hasOne(Team::class, 'id', 'team_id');
    }
}
