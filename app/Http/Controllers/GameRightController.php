<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GameRight;
use App\Models\User;
use Illuminate\Http\Request;

class GameRightController extends Controller
{
    public function create(Game $game){
        $users = User::leftJoin('game_rights', function($join) use ($game) {
            $join->on('game_rights.user_id', '=', 'users.id')
                ->where('game_rights.game_id', '=', $game->id);
        })
            ->whereNull('game_rights.user_id')
            ->where('users.role' ,'!=' , 'superuser')
            ->select('users.*')
            ->get();

        //get all the users without rights to the game
        return view('game-rights.create')->with(['game' => $game , 'users' => $users]);
    }

    public function store(Game $game, Request $request){
        $validated = $request->validate([
            'user_id'=> 'required|exists:users,id',
        ]);

        $gameRight = new GameRight();
        $gameRight->user_id = $validated['user_id'];
        $gameRight->game_id = $game->id;
        $gameRight->save();

        return redirect()->route('games.show', $game)->with(['success'=> 'A new user has been granted access to the game']);
    }
    public function destroy(Game $game , GameRight $gameRight){
        $gameRight->delete_at = now();
        $gameRight->save();

        return redirect()->route('games.show', $game)->with(['success'=> 'User access to the game has been revoked']);
    }
}
