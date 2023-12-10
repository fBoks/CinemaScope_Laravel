<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Film;
use App\Models\Genre;
use App\Models\FilmsGenre;
use App\Models\FilmsCountry;
use App\Models\CinemaWorkersFilms;

class FilmController extends Controller
{
    public function index(Request $request) {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:50'],
            'from_date' => ['nullable', 'string', 'date'],
            'to_date' => ['nullable', 'string', 'date', 'after:from_date'],
        ]);

        // dd($request->toArray());

        $query = Film::query();

        // <Запросы для фильтров>
        if ($search = $validated['search'] ?? null) {
            $query->where('films.name', 'like', "%{$search}%");
        }

        if ($fromDate = $validated['from_date'] ?? null) {
            $query->where('films.realised_at', '>=', new Carbon($fromDate));
        }

        if ($toDate = $validated['to_date'] ?? null) {
            $query->where('films.realised_at', '<=', new Carbon($toDate));
        }

        $searchedGenres = FilmsGenre::query();
        if ($genre_id = $request->genre_id ?? null) {
            $searchedGenres
                ->where('genre_id', '=', $genre_id)
                ->select('film_id');

            $query->whereIn('id', $searchedGenres);
        }

        $films = $query
            ->orderBy('films.name')
            ->paginate(10);

        // добавление каждому фильму коллекции его жанров через функцию модели
        foreach($films as $film) {
            
            $genres = FilmsGenre::query()
                ->where('film_id', $film->id)
                ->join('genres', 'genres.id', '=', 'films_genres.genre_id')
                ->get('genres.name');
            
            $film->setGenres($genres);
            
        }

        foreach($films as $film) {
            $countries = FilmsCountry::query()
                ->where('film_id', $film->id)
                ->join('countries', 'countries.id', '=', 'films_countries.country_id')
                ->get('countries.name');

            $film->setCountries($countries);
        }

        $genres = Genre::query()->orderBy('name')->get();

        return view('films.index', compact('films', 'genres'));
    }

    public function show (string $film_id) {
        $film = Film::query()
            ->findOrFail($film_id);

        $genres = FilmsGenre::query()
            ->where('film_id', $film_id)
            ->join('genres', 'genres.id', '=', 'films_genres.genre_id')
            ->get('genres.name');

        // создание коллекции creators
        $directors = CinemaWorkersFilms::query()
            ->join('cinema_workers_roles as cwr', 'cwr.id', '=', 'cinema_workers_films.cinema_worker_role_id')
            ->join('cinema_industry_roles as cir', 'cir.id', '=', 'cwr.cinema_i_role_id')
            ->join('cinema_workers as cw', 'cw.id', '=', 'cwr.cinema_w_id')
            ->where('cinema_workers_films.film_id', $film_id)
            ->where('cir.name_eng', '=', 'director')
            ->selectRaw("CONCAT(cw.first_name,' ',cw.surname) as name")
            ->get();

        $producers = CinemaWorkersFilms::query()
            ->join('cinema_workers_roles as cwr', 'cwr.id', '=', 'cinema_workers_films.cinema_worker_role_id')
            ->join('cinema_industry_roles as cir', 'cir.id', '=', 'cwr.cinema_i_role_id')
            ->join('cinema_workers as cw', 'cw.id', '=', 'cwr.cinema_w_id')
            ->where('cinema_workers_films.film_id', $film_id)
            ->where('cir.name_eng', '=', 'producer')
            ->selectRaw("CONCAT(cw.first_name,' ',cw.surname) as name")
            ->get();

        $screenwriters = CinemaWorkersFilms::query()
            ->join('cinema_workers_roles as cwr', 'cwr.id', '=', 'cinema_workers_films.cinema_worker_role_id')
            ->join('cinema_industry_roles as cir', 'cir.id', '=', 'cwr.cinema_i_role_id')
            ->join('cinema_workers as cw', 'cw.id', '=', 'cwr.cinema_w_id')
            ->where('cinema_workers_films.film_id', $film_id)
            ->where('cir.name_eng', '=', 'screenwriter')
            ->selectRaw("CONCAT(cw.first_name,' ',cw.surname) as name")
            ->get();

        $creators = collect([
            'directors' => $directors,
            'producers' => $producers,
            'screenwriters' => $screenwriters
        ]);

        // создание коллекции actors
        $actors = CinemaWorkersFilms::query()
            ->join('cinema_workers_roles as cwr', 'cwr.id', '=', 'cinema_workers_films.cinema_worker_role_id')
            ->join('cinema_industry_roles as cir', 'cir.id', '=', 'cwr.cinema_i_role_id')
            ->join('cinema_workers as cw', 'cw.id', '=', 'cwr.cinema_w_id')
            ->where('cinema_workers_films.film_id', $film_id)
            ->where('cir.name_eng', '=', 'actor')
            ->selectRaw("CONCAT(cw.first_name,' ',cw.surname) as name")
            ->get();

        $film->setGenres($genres);
        $film->setCreators($creators);
        $film->setActors($actors);

        return view('films.show', compact('film'));
    }
}
