<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostsLike;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostsLikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts_count = Post::all()->count();
        $users_count = User::all()->count();
        $maxEntries = $posts_count * ($users_count - 2);

        PostsLike::factory()->count($maxEntries)->create();
    }
}
