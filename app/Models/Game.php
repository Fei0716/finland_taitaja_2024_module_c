<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    public function rights(){
        return $this->hasMany(GameRight::class, 'game_id', 'id');
    }

    public function scores(){
        return $this->hasMany(Score::class, 'game_id', 'id');
    }
}
