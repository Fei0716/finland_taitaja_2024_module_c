<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Score;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ScoreController extends Controller
{
    public function index(Game $game){
        return view('scores.index')->with(['game' => $game]);
    }
    public function create(Game $game){
        $users = User::where('role' ,'user')->get();
        return view('scores.create')->with(['game' => $game , 'users'=>  $users]);
    }
    public function store(Game $game,Request $request){
        $validated = $request->validate([
            'user_id'=> 'required|exists:users,id',
            'score' => 'required|min:0',
        ]);
        $gameScore = new Score();
        $gameScore->score = $validated['score'];
        $gameScore->user_id= $validated['user_id'];
        $gameScore->game_id = $game->id;
        $gameScore->save();

        return redirect()->route('scores.index', $game)->with(['success' => 'New game result added successfully']);
    }
    public function edit(Game $game, Score $score){
        $users = User::where('role' ,'user')->get();
        return view('scores.edit')->with(['game' => $game , 'users'=>  $users , 'score' => $score]);
    }
    public function update(Game $game,Score $score,Request $request){
        $validated = $request->validate([
            'user_id'=> 'required|exists:users,id',
            'score' => 'required|min:0',
        ]);
        $score->score = $validated['score'];
        $score->user_id= $validated['user_id'];
        $score->save();

        return redirect()->route('scores.index', $game)->with(['success' => 'Game result updated successfully']);
    }
    public function destroy(Game $game ,Score $score){
        $score->deleted_at = now();
        $score->save();
        return redirect()->route('scores.index', $game)->with(['success' => 'Game result deleted successfully']);
    }

    public function submitScore(Request $request){
        try{
            $game = Game::find($request->gameId);
            if($game){
                //create a new user
                $user = new User();
                $user->name = $request->name;
                $user->role = 'user';
                $user->password = Hash::make('taitaja2024');
                $user->save();

                //store the game Score
                $gameScore = new Score();
                $gameScore->score = $request->score;
                $gameScore->game_id = $game->id;
                $gameScore->user_id = $user->id;
                $gameScore->save();

                return response()->json(['message'=>'Score Saved Successfully'] , 201);
            }
        }catch(\Exception $e){
            return response()->json($e->getMessage());
        }

    }
}
