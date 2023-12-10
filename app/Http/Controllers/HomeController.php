<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\FilmsGenre;
use App\Models\FilmsCountry;
use App\Models\Post;

class HomeController extends Controller
{
    public function index() {
        // --ФИЛЬМЫ--
        $films = Film::query()
            ->orderBy('id', 'desc')
            ->limit(3)
            ->get();

        foreach ($films as $film) {

            $genres = FilmsGenre::query()
                ->where('film_id', $film->id)
                ->join('genres', 'genres.id', '=', 'films_genres.genre_id')
                ->get('genres.name');

            $film->setGenres($genres);

        }

        foreach ($films as $film) {
            $countries = FilmsCountry::query()
                ->where('film_id', $film->id)
                ->join('countries', 'countries.id', '=', 'films_countries.country_id')
                ->get('countries.name');

            $film->setCountries($countries);
        }

        // --СТАТЬИ--
        $posts = Post::query()->join('users', 'users.id', '=', 'posts.user_id')
            ->join('posts_categories', 'posts_categories.id', '=', 'category_id')
            ->join('films', 'films.id', '=', 'film_id')
            ->where('posts.active', '=', true)
            ->whereNotNull('posts.published_at')
            ->orderBy('posts.published_at', 'desc')
            ->limit(3)
            ->get([
                'posts.id as id', 
                'posts.title', 
                'posts_categories.name as category',
                'films.name as film', 
                'posts.published_at',
                'posts.active', 
                'users.login as user_login'
            ]);

        return view('home.index', compact('films', 'posts'));
    }
}
