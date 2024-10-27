<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FixtureStat extends Model
{
    use HasFactory;

    protected $table = "fixture_stat";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fixture_id',
        'identifier',
        'team_type',
        'value',
        'player_id', // element 
    ];
}

