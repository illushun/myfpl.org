<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlayerRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('player_role')->insert([
            'plural_name' => 'Goalkeepers',
            'plural_name_short' => 'GKP',
            'singular_name' => 'Goalkeeper',
            'singular_name_short' => 'GKP',
            'squad_select' => 2,
            'squad_min_select' => null,
            'squad_max_select' => null,
            'squad_min_play' => 1,
            'squad_max_play' => 1,
            'player_count' => 65
        ]);
            
        DB::table('player_role')->insert([
            'plural_name' => 'Defenders',
            'plural_name_short' => 'DEF',
            'singular_name' => 'Defender',
            'singular_name_short' => 'DEF',
            'squad_select' => 5,
            'squad_min_select' => null,
            'squad_max_select' => null,
            'squad_min_play' => 3,
            'squad_max_play' => 5,
            'player_count' => 202
        ]);

        DB::table('player_role')->insert([
            'plural_name' => 'Midfielders',
            'plural_name_short' => 'MID',
            'singular_name' => 'Midfielder',
            'singular_name_short' => 'MID',
            'squad_select' => 5,
            'squad_min_select' => null,
            'squad_max_select' => null,
            'squad_min_play' => 2,
            'squad_max_play' => 5,
            'player_count' => 275
        ]);

        DB::table('player_role')->insert([
            'plural_name' => 'Forwards',
            'plural_name_short' => 'FWD',
            'singular_name' => 'Forward',
            'singular_name_short' => 'FWD',
            'squad_select' => 3,
            'squad_min_select' => null,
            'squad_max_select' => null,
            'squad_min_play' => 1,
            'squad_max_play' => 3,
            'player_count' => 71
        ]);
    }
}
