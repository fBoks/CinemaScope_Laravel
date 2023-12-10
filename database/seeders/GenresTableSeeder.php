<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                // 1
                'name' => 'боевик'
            ],
            [
                // 2
                'name' => 'криминал'
            ],
            [
                // 3
                'name' => 'детектив'
            ],
            [
                // 4
                'name' => 'комедия'
            ],
            [
                // 5
                'name' => 'триллер'
            ],
            [
                // 6
                'name' => 'драма'
            ],
            [
                // 7
                'name' => 'военный'
            ],
            [
                // 8
                'name' => 'мультфильм'
            ],
            [
                // 9
                'name' => 'фентези'
            ],
            [
                // 10
                'name' => 'приключения'
            ],
            [
                // 11
                'name' => 'семейный'
            ],
            [
                // 12
                'name' => 'биография'
            ],
            [
                // 13
                'name' => 'история'
            ],
        ];

        \DB::table('genres')->insert($data);
    }
}
