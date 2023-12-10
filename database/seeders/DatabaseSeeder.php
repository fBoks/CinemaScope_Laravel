<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersRolesTableSeeder::class,
            UsersTableSeeder::class,
            CountriesTableSeeder::class,
            FilmsTableSeeder::class,
            FilmsCountriesSeeder::class,
            GenresTableSeeder::class,
            FilmsGenresTableSeeder::class,
            CinemaWorkersTableSeeder::class,
            CinemaIndustryRolesTableSeeder::class,
            CinemaWorkersRolesTableSeeder::class,
            CinemaWorkersFilmsTableSeeder::class,
            PostsCategoriesTableSeeder::class,
            PostsTableSeeder::class,
            FilmsLikesTableSeeder::class,
            PostsLikesTableSeeder::class,
            CommentsTableSeeder::class,
        ]);
    }
}