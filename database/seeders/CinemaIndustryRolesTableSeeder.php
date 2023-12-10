<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CinemaIndustryRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "name" => "режиссер",
                'name_eng' => 'director'
            ],
            [
                "name" => "сценарист",
                'name_eng' => 'screenwriter'
            ],
            [
                "name" => "продюсер",
                'name_eng' => 'producer'
            ],
            [
                "name" => "актер",
                'name_eng' => 'actor'
            ],
        ];

        \DB::table("cinema_industry_roles")->insert($data);
    }
}
