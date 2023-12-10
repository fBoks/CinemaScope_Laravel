<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostsCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Обзор',
            ],
            [
                'name' => 'Пересказ',
            ],
        ];

        \DB::table('posts_categories')->insert($data);
    }
}
