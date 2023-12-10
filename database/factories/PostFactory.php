<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nbWords = rand(20, 50);
        $title = $this->faker->realText($nbWords);
        $categoryId = rand(1, 2);
        $filmId = rand(1, 8);
        $active = rand(1, 4) > 1;

        return [
            'title' => $title,
            'category_id' => $categoryId,
            'film_id' => $filmId,
            'content' => $this->faker->realText(),
            'active' =>  $active,
            'published_at' => $active ? $this->faker->dateTimeBetween('-1 year', 'now') : null,
            'user_id' => rand(4, 14),
        ];
    }
}
