<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CinemaWorkersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                // 1
                "first_name" => "Олег",
                "surname" => "Трофим",
            ],
            [
                "first_name" => "Артем",
                "surname" => "Габрелянов",
            ],
            [
                "first_name" => "Тихон",
                "surname" => "Жизневский",
            ],
            [
                "first_name" => "Любовь",
                "surname" => "Аксёнова",
            ],
            [
                // 5
                "first_name" => "Алексей",
                "surname" => "Маклаков",
            ],
            [
                "first_name" => "Гай",
                "surname" => "Ричи",
            ],
            [
                "first_name" => "Мэттью",
                "surname" => "Андерсон",
            ],
            [
                "first_name" => "Мэттью",
                "surname" => "МакКонахи",
            ],
            [
                "first_name" => "Чарли",
                "surname" => "Ханнэм",
            ],
            [
                // 10
                "first_name" => "Генри",
                "surname" => "Голдинг",
            ],
            [
                "first_name" => "Люк",
                "surname" => "Бессон",
            ],
            [
                "first_name" => "Клод",
                "surname" => "Бессон",
            ],
            [
                "first_name" => "Жан",
                "surname" => "Рено",
            ],
            [
                "first_name" => "Натали",
                "surname" => "Портман",
            ],
            [
                // 15
                "first_name" => "Гари",
                "surname" => "Олдман",
            ],
            [
                "first_name" => "Квентин",
                "surname" => "Тарантино",
            ],
            [
                "first_name" => "Лоуренс",
                "surname" => "Бендер",
            ],
            [
                "first_name" => "Брэд",
                "surname" => "Питт",
            ],
            [
                "first_name" => "Кристоф",
                "surname" => "Вальц",
            ],
            [
                // 20
                "first_name" => "Мелани",
                "surname" => "Лоран",
            ],
            [
                "first_name" => "Николя",
                "surname" => "Бухриф",
            ],
            [
                "first_name" => "Айван",
                "surname" => "Эткинсон",
            ],
            [
                "first_name" => "Джейсон",
                "surname" => "Стэйтем",
            ],
            [
                "first_name" => "Холт",
                "surname" => "Маккэлани",
            ],
            [
                // 25
                "first_name" => "Джеффри",
                "surname" => "Донован",
            ],
            [
                "first_name" => "Энрико",
                "surname" => "Касароса",
            ],
            [
                "first_name" => "Майк",
                "surname" => "Джонс",
            ],
            [
                "first_name" => "Андреа",
                "surname" => "Уоррен",
            ],
            [
                "first_name" => "Джейкоб",
                "surname" => "Тремблей",
            ],
            [
                // 30
                "first_name" => "Джек",
                "surname" => "Дилан",
            ],
            [
                "first_name" => "Эмма",
                "surname" => "Берман",
            ],
            [
                "first_name" => "Пон",
                "surname" => "Джун-хо",
            ],
            [
                "first_name" => "Квак",
                "surname" => "Щин-э",
            ],
            [
                "first_name" => "Сон",
                "surname" => "Кан-хо",
            ],
            [
                // 35
                "first_name" => "Ли",
                "surname" => "Сон-гюн",
            ],
            [
                "first_name" => "Чо",
                "surname" => "Ё-джон",
            ],
            [
                "first_name" => "Мэл",
                "surname" => "Гибсон",
            ],
            [
                "first_name" => "Роберт",
                "surname" => "Шенккан",
            ],
            [
                "first_name" => "Майкл",
                "surname" => "Бэссик",
            ],
            [
                //40
                "first_name" => "Эндрю",
                "surname" => "Гарфилд",
            ],
            [
                "first_name" => "Сэм",
                "surname" => "Уоррингтон",
            ],
            [
                "first_name" => "Тереза",
                "surname" => "Палмер",
            ],
        ];

        \DB::table("cinema_workers")->insert($data);
    }
}
