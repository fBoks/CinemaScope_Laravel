<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CinemaWorkersFilmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Майор гром: Чумной доктор
            [
                'cinema_worker_role_id' => 1,
                'film_id' => 1
            ],
            [
                'cinema_worker_role_id' => 4,
                'film_id' => 1
            ],
            [
                'cinema_worker_role_id' => 5,
                'film_id' => 1
            ],
            [
                'cinema_worker_role_id' => 7,
                'film_id' => 1
            ],
            [
                'cinema_worker_role_id' => 8,
                'film_id' => 1
            ],
            [
                'cinema_worker_role_id' => 9,
                'film_id' => 1
            ],

            // Джентльмены
            [
                'cinema_worker_role_id' => 10,
                'film_id' => 2
            ],
            [
                'cinema_worker_role_id' => 11,
                'film_id' => 2
            ],
            [
                'cinema_worker_role_id' => 13,
                'film_id' => 2
            ],
            [
                'cinema_worker_role_id' => 14,
                'film_id' => 2
            ],
            [
                'cinema_worker_role_id' => 17,
                'film_id' => 2
            ],
            [
                'cinema_worker_role_id' => 19,
                'film_id' => 2
            ],

            //Леон
            [
                'cinema_worker_role_id' => 23,
                'film_id' => 3
            ],
            [
                'cinema_worker_role_id' => 22,
                'film_id' => 3
            ],
            [
                'cinema_worker_role_id' => 24,
                'film_id' => 3
            ],
            [
                'cinema_worker_role_id' => 27,
                'film_id' => 3
            ],
            [
                'cinema_worker_role_id' => 28,
                'film_id' => 3
            ],
            [
                'cinema_worker_role_id' => 31,
                'film_id' => 3
            ],

            // Бесславные ублюдки
            [
                'cinema_worker_role_id' => 36,
                'film_id' => 4
            ],
            [
                'cinema_worker_role_id' => 35,
                'film_id' => 4
            ],
            [
                'cinema_worker_role_id' => 37,
                'film_id' => 4
            ],
            [
                'cinema_worker_role_id' => 40,
                'film_id' => 4
            ],
            [
                'cinema_worker_role_id' => 42,
                'film_id' => 4
            ],
            [
                'cinema_worker_role_id' => 45,
                'film_id' => 4
            ],

            // Гнев человеческий
            [
                'cinema_worker_role_id' => 10,
                'film_id' => 5
            ],
            [
                'cinema_worker_role_id' => 48,
                'film_id' => 5
            ],
            [
                'cinema_worker_role_id' => 51,
                'film_id' => 5
            ],
            [
                'cinema_worker_role_id' => 54,
                'film_id' => 5
            ],
            [
                'cinema_worker_role_id' => 56,
                'film_id' => 5
            ],
            [
                'cinema_worker_role_id' => 59,
                'film_id' => 5
            ],

            // Лука
            [
                'cinema_worker_role_id' => 62,
                'film_id' => 6
            ],
            [
                'cinema_worker_role_id' => 65,
                'film_id' => 6
            ],
            [
                'cinema_worker_role_id' => 66,
                'film_id' => 6
            ],
            [
                'cinema_worker_role_id' => 67,
                'film_id' => 6
            ],
            [
                'cinema_worker_role_id' => 68,
                'film_id' => 6
            ],
            [
                'cinema_worker_role_id' => 70,
                'film_id' => 6
            ],

            // Паразиты
            [
                'cinema_worker_role_id' => 71,
                'film_id' => 7
            ],
            [
                'cinema_worker_role_id' => 72,
                'film_id' => 7
            ],
            [
                'cinema_worker_role_id' => 74,
                'film_id' => 7
            ],
            [
                'cinema_worker_role_id' => 76,
                'film_id' => 7
            ],
            [
                'cinema_worker_role_id' => 77,
                'film_id' => 7
            ],
            [
                'cinema_worker_role_id' => 78,
                'film_id' => 7
            ],

            // По соображениям совести
            [
                'cinema_worker_role_id' => 81,
                'film_id' => 8
            ],
            [
                'cinema_worker_role_id' => 83,
                'film_id' => 8
            ],
            [
                'cinema_worker_role_id' => 85,
                'film_id' => 8
            ],
            [
                'cinema_worker_role_id' => 86,
                'film_id' => 8
            ],
            [
                'cinema_worker_role_id' => 88,
                'film_id' => 8
            ],
            [
                'cinema_worker_role_id' => 91,
                'film_id' => 8
            ],
        ];

        \DB::table("cinema_workers_films")->insert($data);
    }
}
