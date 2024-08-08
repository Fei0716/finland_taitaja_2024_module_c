<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'admin',
                'password'=> Hash::make('taitaja2024'),
                'role' => 'superuser',
            ],
            [
                'name' => 'user',
                'password'=> Hash::make('taitaja2024'),
                'role' => 'user',
            ],
        ]);
    }
}
