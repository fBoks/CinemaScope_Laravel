<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FilmsCountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =[
            [
                'film_id' => '1',
                'country_id' => '1'
            ],
            [
                'film_id' => '2',
                'country_id' => '2'
            ],
            [
                'film_id' => '3',
                'country_id' => '3'
            ],
            [
                'film_id' => '4',
                'country_id' => '4'
            ],
            [
                'film_id' => '5',
                'country_id' => '5'
            ],
            [
                'film_id' => '6',
                'country_id' => '6'
            ],
            [
                'film_id' => '7',
                'country_id' => '7'
            ],
            [
                'film_id' => '8',
                'country_id' => '8'
            ],
        ];

        \DB::table('films_countries')->insert($data);
    }
}
