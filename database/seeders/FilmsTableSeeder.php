<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FilmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Майор Гром: Чумной Доктор',
                'tagline' => 'Кто твой герой?',
                'description' => 'Майор полиции Игорь Гром известен всему Санкт-Петербургу пробивным характером и непримиримой позицией по отношению к преступникам всех мастей. Неимоверная сила, аналитический склад ума и неподкупность — всё это делает майора Грома идеальным полицейским. Но всё резко меняется с появлением человека в маске Чумного Доктора. Заявив, что его город «болен чумой беззакония», он принимается за «лечение», убивая людей, которые в своё время избежали наказания при помощи денег и влияния. Общество взбудоражено. Полиция бессильна. Игорь впервые сталкивается с трудностями в расследовании, от итогов которого может зависеть судьба всего города.',
                'realised_at' => '2021-07-07',
            ],
            [
                'name' => 'Джентльмены',
                'tagline' => 'Criminal. Class',
                'description' => 'Один ушлый американец ещё со студенческих лет приторговывал наркотиками, а теперь придумал схему нелегального обогащения с использованием поместий обедневшей английской аристократии и очень неплохо на этом разбогател. Другой пронырливый журналист приходит к Рэю, правой руке американца, и предлагает тому купить киносценарий, в котором подробно описаны преступления его босса при участии других представителей лондонского криминального мира — партнёра-еврея, китайской диаспоры, чернокожих спортсменов и даже русского олигарха.',
                'realised_at' => '2019-12-03',
            ],
            [
                'name' => 'Леон',
                'tagline' => 'Вы не можете остановить того, кого не видно',
                'description' => 'Профессиональный убийца Леон неожиданно для себя самого решает помочь 12-летней соседке Матильде, семью которой убили коррумпированные полицейские.',
                'realised_at' => '1994-09-14',
            ],
            [
                'name' => 'Бесславные ублюдки',
                'tagline' => 'Они мстят бодро, весело, со вкусом',
                'description' => 'Вторая мировая война. В оккупированной немцами Франции группа американских солдат-евреев наводит страх на нацистов, жестоко убивая и скальпируя солдат.',
                'realised_at' => '2009-05-20',
            ],
            [
                'name' => 'Гнев человеческий',
                'tagline' => '-',
                'description' => 'Грузовики лос-анджелесской инкассаторской компании Fortico Security часто подвергаются нападениям, и во время очередного ограбления погибают оба охранника. Через некоторое время в компанию устраивается крепкий немногословный британец Патрик Хилл. Он получает от босса прозвище Эйч и, впритык к необходимому минимуму пройдя тесты по фитнесу, стрельбе и вождению, отправляется на первое задание. Вскоре и его грузовик пытаются ограбить вооруженные налётчики, но Эйч в одиночку расправляется с целой бандой и становится героем. Кажется, слава и уважение коллег его совершенно не интересуют, ведь он преследует свои цели.',
                'realised_at' => '2021-04-22',
            ],
            [
                'name' => 'Лука',
                'tagline' => 'Prepare for an unforgettable trip',
                'description' => 'Незабываемые каникулы, в которых есть место и домашней пасте, и мороженому, и бесконечным поездкам на мопеде, мальчик Лука проводит в красивом приморском городке на итальянской Ривьере. Ни одно приключение Луки не обходится без участия его нового лучшего друга, и беззаботность отдыха омрачает только лишь тот факт, что на самом деле в облике мальчика скрывается морской монстр из глубин лагуны, на берегу которой стоит городок.',
                'realised_at' => '2021-06-17',
            ],
            [
                'name' => 'Паразиты',
                'tagline' => 'Найди злоумышленника',
                'description' => 'Обычное корейское семейство Кимов жизнь не балует. Приходится жить в сыром грязном полуподвале, воровать интернет у соседей и перебиваться случайными подработками. Однажды друг сына семейства, уезжая на стажировку за границу, предлагает тому заменить его и поработать репетитором у старшеклассницы в богатой семье Пак. Подделав диплом о высшем образовании, парень отправляется в шикарный дизайнерский особняк и производит на хозяйку дома хорошее впечатление. Тут же ему в голову приходит необычный план по трудоустройству сестры.',
                'realised_at' => '2019-05-21',
            ],
            [
                'name' => 'По соображениям совести',
                'tagline' => 'Основано на реальной истории',
                'description' => 'Медик американской армии времён Второй мировой войны Десмонд Досс, который служил во время битвы за Окинаву, отказывается убивать людей и становится первым идейным уклонистом в американской истории, удостоенным Медали Почёта.',
                'realised_at' => '2016-09-04',
            ],
        ];

        \DB::table('films')->insert($data);
    }
}
