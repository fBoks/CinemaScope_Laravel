<?php

namespace Database\Factories;

use App\Models\Film;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FilmsLike>
 */
class FilmsLikeFactory extends Factory
{
    protected $created = 0;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // https://stackoverflow.com/questions/43202886/laravel-seeding-multiple-unique-columns-with-faker

        // очистка списка уникальных значений перед записью
        if ($this->created == 0) {
            $this->faker->unique(true);
        }
        $this->created++;

        // получаем количество записей из БД для соответствующих моделей
        $film_id = Film::all()->count();
        $user_id = User::all()->count();

        // создаём массив строк "1-1", "1-2", ... 
        $films_users = [];
        for($i = 1; $i <= $film_id; $i++) {
            for ($j = 1; $j <= $user_id; $j++) {
                array_push($films_users, $i . '-' . $j);
            }
        }

        // для каждой итерации берем уникальный элемент массива
        $film_and_user = $this->faker->unique()->randomElement($films_users);

        $film_and_user = explode('-', $film_and_user);
        $film_id = $film_and_user[0];
        $user_id = $film_and_user[1];

        return [
            'film_id' => $film_id,
            'user_id' => $user_id,
            'like' => rand(0, 1),
        ];
    }
}
