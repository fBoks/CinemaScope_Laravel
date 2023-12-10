<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostsLike>
 */
class PostsLikeFactory extends Factory
{
    protected $created = 0;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        if ($this->created == 0) {
            $this->faker->unique(true);
        }
        $this->created++;

        $post_id = Post::all()->count();
        $user_id = User::all()->count();

        $posts_users = [];
        for($i = 1; $i <= $post_id; $i++) {
            for ($j = 1; $j <= $user_id; $j++) {
                array_push($posts_users, $i . '-' . $j);
            }
        }

        $post_and_user = $this->faker->unique()->randomElement($posts_users);

        $post_and_user = explode('-', $post_and_user);
        $post_id = $post_and_user[0];
        $user_id = $post_and_user[1];

        return [
            'post_id' => $post_id,
            'user_id' => $user_id,
            'like' => rand(0, 1),
        ];
    }
}
