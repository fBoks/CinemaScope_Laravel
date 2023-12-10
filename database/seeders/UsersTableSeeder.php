<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'login' => 'admin',
                'registered_at' => now(),
                'email' => 'admin@mail.ru',
                'password' => Hash::make('admin2281488#'),
                'role_id' => 'admin'
            ],
            [
                'login' => 'moderator',
                'registered_at' => now(),
                'email' => 'moderator@mail.ru',
                'password' => Hash::make('moderator2281488#'),
                'role_id' => 'moderator'
            ],
            [
                'login' => 'user',
                'registered_at' => now(),
                'email' => 'user@mail.ru',
                'password' => Hash::make('user2281488#'),
                'role_id' => 'user'
            ],
            [
                'login' => 'author',
                'registered_at' => now(),
                'email' => 'author@mail.ru',
                'password' => Hash::make('author2281488#'),
                'role_id' => 'author'
            ]
        ];

        \DB::table('users')->insert($data);
        
        User::factory()->count(10)->create();
    }
}
