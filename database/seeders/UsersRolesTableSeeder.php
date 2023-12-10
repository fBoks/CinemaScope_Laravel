<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'created_at' => now(),
                'id' => 'admin',
                'name' => 'Администратор'
            ],
            [
                'created_at' => now(),
                'id' => 'moderator',
                'name' => 'Модератор'
            ],
            [
                'created_at' => now(),
                'id' => 'user',
                'name' => 'Пользователь'
            ],
            [
                'created_at' => now(),
                'id' => 'author',
                'name' => 'Автор'
            ]
        ];

        \DB::table('users_roles')->insert($data);
    }
}
