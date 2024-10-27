<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Fixture;

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
        'name',
        'deadline',
        'deadline_offset',
        'is_previous',
        'is_current',
        'is_next',
    ];

    public function fixtures(): HasMany {
        return $this->hasMany(Fixture::class, 'gameweek_id');
    }
}
