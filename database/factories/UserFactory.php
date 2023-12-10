<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    public function definition(): array
    {
        $role_id = rand(1, 4) < 4 ? 'user' : 'author';
        
        return [
            'login' => $this->faker->unique->userName,
            'registered_at' => $this->faker->dateTimeBetween('-2 years', '-1 year'),
            'email' => $this->faker->unique->safeEmail,
            'password' => Hash::make($this->faker->password),
            'role_id' => $role_id,
        ];
    }
}
