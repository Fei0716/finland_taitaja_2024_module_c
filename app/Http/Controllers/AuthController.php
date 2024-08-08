<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginPage(){
        return view('auth.login');
    }
    public function login(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);
        $user = User::where([
            'name' => $validated['name'],
        ])->first();
        if($user && Hash::check($validated['password'] , $user->password)){
           Auth::login($user);
            switch($user->role){
                case 'superuser':
                    return redirect()->route('users.index');
                case 'user':
                    return redirect()->route('games.index');
                default:break;
            }
        }
        return back()->withErrors(['name'=> 'Invalid username or password']);
    }
    public function logout(User $user){
        Auth::logout();
        return redirect()->route('login')->with(['success'=>'Logged out successfully']);
    }
}
