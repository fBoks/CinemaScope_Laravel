<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $post_count = Post::all()->count();
        $user_count = User::all()->count();

        return [
            'post_id' => rand(1, $post_count),
            'user_id' => rand(3, $user_count),
            'text' => $this->faker->realText(),
            'commented_at' => $this->faker->dateTimeBetween('-1 years', 'now'),
        ];
    }
}
