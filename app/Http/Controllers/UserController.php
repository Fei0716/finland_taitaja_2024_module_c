<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $users = User::where([
            'deleted_at' => null
        ])->get();
        return view('users.index')->with(['users' => $users]);
    }
    public function create(){
        return view('users.create');
    }
    public function store(Request $request){
      $validated = $request->validate([
          'name'=> 'required|unique:users',
      ]);

      $user = new User();
      $user->name = $validated['name'];
      $user->password = $request->password ? Hash::make($request->password) :   Hash::make('taitaja2024');
      $user->role = 'user';
      $user->save();

      return redirect()->route('users.index')->with(['success'=>'User created successfully']);
    }

    public function destroy(User $user,Request $request){
        $user->deleted_at = now();
        $user->save();
        return redirect()->route('users.index')->with(['success'=>'User deleted successfully']);
    }
    public function edit(User $user){
        return view('users.edit')->with(['user' => $user]);
    }
    public function update(User $user, Request $request){
        $validated = $request->validate([
            'name'=> 'required',
        ]);
        $user->name = $request->name;
//        if there's a new password
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('users.index')->with(['success'=>'User updated successfully']);
    }

    //show user profile
    public function show(User $user){
        return view('users.show')->with(['user'=> $user]);
    }

    public function updatePassword(User $user, Request $request){
        $validated = $request->validate([
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        $user->password = Hash::make($validated['password']);
        $user->save();

        return redirect()->route('users.show', $user)->with(['success' => 'Password updated successfully']);
    }
}
