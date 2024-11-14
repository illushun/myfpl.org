<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;

class PlayersViewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('players.players-view');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $player = Player::find($id);
            if (!$player) {
                return $this->index();
            }

            return view('players.player-view', [
                'player' => $player,
            ]);
        } catch (\Exception $e) {
           return $this->index(); 
        }
    }
}
