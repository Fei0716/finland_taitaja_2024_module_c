<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{
    public function index(){
        $games = Game::where([
            'deleted_at' => null
        ])->get();
        return view('games.index')->with(['games' => $games]);
    }
    public function create(){
        return view('games.create');
    }
    public function store(Request $request){
        $validated = $request->validate([
            'title'=> 'required|unique:games',
            'result_no' => 'required|integer|min:0',
            'image' => 'file|image',
        ]);

//        for handling image
        $imageName = null;
        if($request->file('image')){
            $image = $request->file('image');
            $imageName = uniqid('', true).'.'. $image->getClientOriginalExtension();
            Storage::putFileAs('public/images', $image, $imageName);
        }
        $game = new Game();
        $game->title = $validated['title'];
        $game->image = 'images/'. $imageName ?? null;
        $game->result_no = $validated['result_no'];
        $game->save();

        return redirect()->route('games.index')->with(['success' => 'Game created successfully']);
    }

    public function edit(Game $game){
        return view('games.edit')->with(['game'=> $game]);
    }

    public function update(Game $game,Request $request){
        $validated = $request->validate([
            'title'=> 'required|unique:games,title,'.$game->id,//unique rule but does not apply to the current value
            'result_no' => 'required|integer|min:0',
            'image' => 'image',
        ]);

//        for handling image
        $imageName = null;
        if($request->file('image')){
            //delete the old image
            if($game->image){
                Storage::disk('public')->delete($game->image);
            }
            $image = $request->file('image');
            $imageName = uniqid('', true).'.'. $image->getClientOriginalExtension();
            Storage::putFileAs('public/images', $image, $imageName);
        }
        $game->title = $validated['title'];
        $game->image = 'images/'. $imageName ?? null;
        $game->result_no = $validated['result_no'];
        $game->save();

        return redirect()->route('games.index')->with(['success' => 'Game updated successfully']);
    }

    public function destroy(Game $game){
        $game->deleted_at = now();
        $game->save();
        return redirect()->route('games.index')->with(['success' => 'Game deleted successfully']);
    }

//    show the game rights of the game
    public function show(Game $game){
        return view('games.show')->with(['game' => $game]);
    }

}
