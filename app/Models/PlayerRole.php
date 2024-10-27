<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerRole extends Model
{
    use HasFactory;

    protected $table = "player_role";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'plural_name',
        'plural_name_short',
        'singular_name',
        'singular_name_short',
        'squad_select',
        'squad_min_select',
        'squad_max_select',
        'squad_min_play',
        'squad_max_play',
        'player_count',
    ];
}
