<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FilmsGenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'film_id' => '1',
                'genre_id' => '1',
            ],
            [
                'film_id' => '1',
                'genre_id' => '2',
            ],
            [
                'film_id' => '1',
                'genre_id' => '3',
            ],
            [
                'film_id' => '1',
                'genre_id' => '4',
            ],
            [
                'film_id' => '2',
                'genre_id' => '2',
            ],
            [
                'film_id' => '2',
                'genre_id' => '4',
            ],
            [
                'film_id' => '2',
                'genre_id' => '1',
            ],
            [
                'film_id' => '3',
                'genre_id' => '1',
            ],
            [
                'film_id' => '3',
                'genre_id' => '5',
            ],
            [
                'film_id' => '3',
                'genre_id' => '6',
            ],
            [
                'film_id' => '3',
                'genre_id' => '2',
            ],
            [
                'film_id' => '4',
                'genre_id' => '1',
            ],
            [
                'film_id' => '4',
                'genre_id' => '6',
            ],
            [
                'film_id' => '4',
                'genre_id' => '4',
            ],
            [
                'film_id' => '4',
                'genre_id' => '7',
            ],
            [
                'film_id' => '5',
                'genre_id' => '1',
            ],
            [
                'film_id' => '5',
                'genre_id' => '5',
            ],
            [
                'film_id' => '6',
                'genre_id' => '8',
            ],
            [
                'film_id' => '6',
                'genre_id' => '9',
            ],
            [
                'film_id' => '6',
                'genre_id' => '4',
            ],
            [
                'film_id' => '6',
                'genre_id' => '10',
            ],
            [
                'film_id' => '6',
                'genre_id' => '11',
            ],
            [
                'film_id' => '7',
                'genre_id' => '6',
            ],
            [
                'film_id' => '7',
                'genre_id' => '5',
            ],
            [
                'film_id' => '7',
                'genre_id' => '4',
            ],
            [
                'film_id' => '8',
                'genre_id' => '12',
            ],
            [
                'film_id' => '8',
                'genre_id' => '7',
            ],
            [
                'film_id' => '8',
                'genre_id' => '6',
            ],
            [
                'film_id' => '8',
                'genre_id' => '13',
            ],
        ];

        \DB::table('films_genres')->insert($data);
    }
}
