<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Россия'],
            ['name' => 'США'],
            ['name' => 'Франция'],
            ['name' => 'Германия'],
            ['name' => 'Великобритания'],
            ['name' => 'Италия'],
            ['name' => 'Южная Корея'],
            ['name' => 'Австралия'],
        ];

        \DB::table('countries')->insert($data);
    }
}
