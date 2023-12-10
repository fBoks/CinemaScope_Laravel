<?php

namespace App\Http\Controllers\Admin\Films;

use App\Models\CinemaWorkersFilms;
use App\Models\CinemaWorkersRole;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use App\Models\Film;
use App\Models\Genre;
use App\Models\FilmsGenre;
use App\Models\FilmsCountry;

class FilmController extends Controller
{

    public function index(Request $request) {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:50'],
            'from_date' => ['nullable', 'string', 'date'],
            'to_date' => ['nullable', 'string', 'date', 'after:from_date'],
        ]);

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

        $genres = Genre::query()->orderBy('name')->get();

        return view('admin.films.index', compact('films', 'genres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::query()->get();

        $countries = Country::query()->get();

        $actors = CinemaWorkersRole::query()
            ->join('cinema_workers', 'cinema_workers.id', '=', 'cinema_workers_roles.cinema_w_id')
            ->where('cinema_workers_roles.cinema_i_role_id', 4)
            ->orderBy('cinema_workers.first_name')
            ->get(['cinema_workers.id', 'cinema_workers.first_name', 'cinema_workers.surname']);

        $directors = CinemaWorkersRole::query()
            ->join('cinema_workers', 'cinema_workers.id', '=', 'cinema_workers_roles.cinema_w_id')
            ->where('cinema_workers_roles.cinema_i_role_id', 1)
            ->orderBy('cinema_workers.first_name')
            ->get(['cinema_workers.id', 'cinema_workers.first_name', 'cinema_workers.surname']);

        $screenwriters = CinemaWorkersRole::query()
            ->join('cinema_workers', 'cinema_workers.id', '=', 'cinema_workers_roles.cinema_w_id')
            ->where('cinema_workers_roles.cinema_i_role_id', 2)
            ->orderBy('cinema_workers.first_name')
            ->get(['cinema_workers.id', 'cinema_workers.first_name', 'cinema_workers.surname']);

        $producers = CinemaWorkersRole::query()
            ->join('cinema_workers', 'cinema_workers.id', '=', 'cinema_workers_roles.cinema_w_id')
            ->where('cinema_workers_roles.cinema_i_role_id', 3)
            ->orderBy('cinema_workers.first_name')
            ->get(['cinema_workers.id', 'cinema_workers.first_name', 'cinema_workers.surname']);

        return view('admin.films.create', compact(['genres', 'countries', 'actors', 'directors', 'screenwriters', 'producers']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'tagline' => ['nullable','max:50', 'string'],
            'description' => ['required', 'string'],
            'realised_at' => ['required', 'date'],
            'genres' => ['required'],
            'countries' => ['required'],
            'actors' => ['required'],
            'directors' => ['required'],
            'screenwriters' => ['required'],
            'producers' => ['required'],
        ]);

        $film = Film::query()
            ->create([
                'name' => $validated['name'],
                'tagline' => $validated['tagline'],
                'description' => $validated['description'],
                'realised_at' => new Carbon($validated['realised_at']),
            ]);

        foreach($validated['genres'] as $genre) {
            FilmsGenre::query()
                ->create([
                    'film_id' => $film->id,
                    'genre_id' => $genre
                ]);
        }

        foreach($validated['countries'] as $country)
        {
            FilmsCountry::query()
                ->create([
                    'film_id' => $film->id,
                    'country_id' => $country
                ]);
        }

        foreach($validated['actors'] as $actor) {
            $worker_role_id = CinemaWorkersRole::query()
                ->where('cinema_w_id', $actor)
                ->where('cinema_i_role_id', '4')
                ->first('id');

            CinemaWorkersFilms::query()
                ->create([
                    'cinema_worker_role_id' => $worker_role_id->id,
                    'film_id' => $film->id
                ]);
        }

        foreach($validated['directors'] as $director) {
            $worker_role_id = CinemaWorkersRole::query()
                ->where('cinema_w_id', $director)
                ->where('cinema_i_role_id', '1')
                ->first('id');

            CinemaWorkersFilms::query()
                ->create([
                    'cinema_worker_role_id' => $worker_role_id->id,
                    'film_id' => $film->id
                ]);
        }

        foreach($validated['screenwriters'] as $screenwriter) {
            $worker_role_id = CinemaWorkersRole::query()
                ->where('cinema_w_id', $screenwriter)
                ->where('cinema_i_role_id', '2')
                ->first('id');

            CinemaWorkersFilms::query()
                ->create([
                    'cinema_worker_role_id' => $worker_role_id->id,
                    'film_id' => $film->id
                ]);
        }

        foreach($validated['producers'] as $producer) {
            $worker_role_id = CinemaWorkersRole::query()
                ->where('cinema_w_id', $producer)
                ->where('cinema_i_role_id', '3')
                ->first('id');

            CinemaWorkersFilms::query()
                ->create([
                    'cinema_worker_role_id' => $worker_role_id->id,
                    'film_id' => $film->id
                ]);
        }

        return redirect()->route('films.show', $film->id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $film_id)
    {
        $film = Film::query()->findOrFail($film_id);

        // genres
        $genres = Genre::query()->get();

        $genres_selected = FilmsGenre::query()
            ->where('film_id', $film_id)
            ->get(['genre_id as id']);

        // countries
        $countries = Country::query()->get();

        $countries_selected = FilmsCountry::query()
            ->where('film_id', $film_id)
            ->get();

        // actors
        $actors = CinemaWorkersRole::query()
            ->join('cinema_workers', 'cinema_workers.id', '=', 'cinema_workers_roles.cinema_w_id')
            ->where('cinema_workers_roles.cinema_i_role_id', 4)
            ->orderBy('cinema_workers.first_name')
            ->get(['cinema_workers.id', 'cinema_workers.first_name', 'cinema_workers.surname']);

        $actors_selected = CinemaWorkersFilms::query()
            ->join('cinema_workers_roles', 'cinema_workers_roles.id', '=', 'cinema_workers_films.cinema_worker_role_id')
            ->join('cinema_workers', 'cinema_workers.id', '=', 'cinema_workers_roles.cinema_w_id')
            ->where('cinema_workers_films.film_id', $film_id)
            ->where('cinema_workers_roles.cinema_i_role_id', 4)
            ->get(['cinema_workers.id']);

        // directors
        $directors = CinemaWorkersRole::query()
            ->join('cinema_workers', 'cinema_workers.id', '=', 'cinema_workers_roles.cinema_w_id')
            ->where('cinema_workers_roles.cinema_i_role_id', 1)
            ->orderBy('cinema_workers.first_name')
            ->get(['cinema_workers.id', 'cinema_workers.first_name', 'cinema_workers.surname']);

        $directors_selected = CinemaWorkersFilms::query()
            ->join('cinema_workers_roles', 'cinema_workers_roles.id', '=', 'cinema_workers_films.cinema_worker_role_id')
            ->join('cinema_workers', 'cinema_workers.id', '=', 'cinema_workers_roles.cinema_w_id')
            ->where('cinema_workers_films.film_id', $film_id)
            ->where('cinema_workers_roles.cinema_i_role_id', 1)
            ->get(['cinema_workers.id']);

        // screenwriters
        $screenwriters = CinemaWorkersRole::query()
            ->join('cinema_workers', 'cinema_workers.id', '=', 'cinema_workers_roles.cinema_w_id')
            ->where('cinema_workers_roles.cinema_i_role_id', 2)
            ->orderBy('cinema_workers.first_name')
            ->get(['cinema_workers.id', 'cinema_workers.first_name', 'cinema_workers.surname']);

        $screenwriters_selected = CinemaWorkersFilms::query()
            ->join('cinema_workers_roles', 'cinema_workers_roles.id', '=', 'cinema_workers_films.cinema_worker_role_id')
            ->join('cinema_workers', 'cinema_workers.id', '=', 'cinema_workers_roles.cinema_w_id')
            ->where('cinema_workers_films.film_id', $film_id)
            ->where('cinema_workers_roles.cinema_i_role_id', 2)
            ->get(['cinema_workers.id']);

        // producers
        $producers = CinemaWorkersRole::query()
            ->join('cinema_workers', 'cinema_workers.id', '=', 'cinema_workers_roles.cinema_w_id')
            ->where('cinema_workers_roles.cinema_i_role_id', 3)
            ->orderBy('cinema_workers.first_name')
            ->get(['cinema_workers.id', 'cinema_workers.first_name', 'cinema_workers.surname']);

        $producers_selected = CinemaWorkersFilms::query()
            ->join('cinema_workers_roles', 'cinema_workers_roles.id', '=', 'cinema_workers_films.cinema_worker_role_id')
            ->join('cinema_workers', 'cinema_workers.id', '=', 'cinema_workers_roles.cinema_w_id')
            ->where('cinema_workers_films.film_id', $film_id)
            ->where('cinema_workers_roles.cinema_i_role_id', 3)
            ->get(['cinema_workers.id']);

        return view('admin.films.edit', compact([
            'film', 
            'genres', 'genres_selected', 
            'countries', 'countries_selected', 
            'actors', 'actors_selected',
            'directors', 'directors_selected',
            'screenwriters', 'screenwriters_selected',
            'producers', 'producers_selected',
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $film_id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'tagline' => ['nullable', 'max:50', 'string'],
            'description' => ['required', 'string'],
            'realised_at' => ['required', 'date'],
            'genres' => ['required'],
            'countries' => ['required'],
            'actors' => ['required'],
            'directors' => ['required'],
            'screenwriters' => ['required'],
            'producers' => ['required'],
        ]);

        Film::query()
            ->where('id', $film_id)
            ->update([
                'name' => $validated['name'],
                'tagline' => $validated['tagline'],
                'description' => $validated['description'],
                'realised_at' => new Carbon($validated['realised_at']),
            ]);

        FilmsGenre::query()
            ->where('film_id', $film_id)
            ->delete();

        foreach ($validated['genres'] as $genre) {
            FilmsGenre::query()
                ->create([
                    'film_id' => $film_id,
                    'genre_id' => $genre
                ]);
        }

        FilmsCountry::query()
            ->where('film_id', $film_id)
            ->delete();

        foreach ($validated['countries'] as $country) {
            FilmsCountry::query()
                ->create([
                        'film_id' => $film_id,
                        'country_id' => $country
                    ]);
        }

        CinemaWorkersFilms::query()
            ->where('film_id', $film_id)
            ->delete();

        foreach ($validated['actors'] as $actor) {
            $worker_role_id = CinemaWorkersRole::query()
                ->where('cinema_w_id', $actor)
                ->where('cinema_i_role_id', '4')
                ->first('id');

            CinemaWorkersFilms::query()
                ->create([
                        'cinema_worker_role_id' => $worker_role_id->id,
                        'film_id' => $film_id
                    ]);
        }

        foreach ($validated['directors'] as $director) {
            $worker_role_id = CinemaWorkersRole::query()
                ->where('cinema_w_id', $director)
                ->where('cinema_i_role_id', '1')
                ->first('id');

            CinemaWorkersFilms::query()
                ->updateOrCreate([
                        'cinema_worker_role_id' => $worker_role_id->id,
                        'film_id' => $film_id
                    ]);
        }

        foreach ($validated['screenwriters'] as $screenwriter) {
            $worker_role_id = CinemaWorkersRole::query()
                ->where('cinema_w_id', $screenwriter)
                ->where('cinema_i_role_id', '2')
                ->first('id');

            CinemaWorkersFilms::query()
                ->updateOrCreate([
                        'cinema_worker_role_id' => $worker_role_id->id,
                        'film_id' => $film_id
                    ]);
        }

        foreach ($validated['producers'] as $producer) {
            $worker_role_id = CinemaWorkersRole::query()
                ->where('cinema_w_id', $producer)
                ->where('cinema_i_role_id', '3')
                ->first('id');

            CinemaWorkersFilms::query()
                ->updateOrCreate([
                        'cinema_worker_role_id' => $worker_role_id->id,
                        'film_id' => $film_id
                    ]);
        }

        alert(__('Изменения сохранены!'));
        return redirect()->route('films.show', $film_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $film)
    {
        Film::query()
            ->where('id', $film)
            ->delete();
        
        return redirect()->route('films');
    }
}
