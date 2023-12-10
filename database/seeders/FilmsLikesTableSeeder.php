<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\FilmsLike;
use App\Models\User;
use Illuminate\Database\Seeder;

class FilmsLikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $films_count = Film::all()->count();
        $users_count = User::all()->count();
        $maxEntries = $films_count * $users_count;

        FilmsLike::factory()->count($maxEntries)->create();
    }
}
