<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameRight extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function game(){
        return $this->belongsTo(Game::class, 'game_id', 'id');
    }
}
