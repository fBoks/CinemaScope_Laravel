<?php

namespace App\Http\Controllers\Admin\Films;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\Genre;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class FilmGenreController extends Controller
{
    public function index(Request $request) {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:50'],
        ]);

        $query = Genre::query();

        // <Запросы для фильтров>
        if ($search = $validated['search'] ?? null) {
            $query->where('genres.name', 'like', "%{$search}%");
        }

        $genres = $query
            ->orderBy('name')
            ->paginate(10);

        return view('admin.films.genres.index', compact('genres'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'search' => ['required', 'string', 'unique:genres,name'],
        ]);

        Genre::query()->insert(['name' => $validated['search']]);

        alert(__("Жанр {$validated['search']} успешно создан!"));
        return redirect()->route('admin.films.genres');
    }

    public function delete(string $genre)
    {   
        Film::query()
            ->whereExists(function (Builder $query) use ($genre) {
                $query->select('*')
                    ->from('films_genres')
                    ->where('films_genres.genre_id', $genre)
                    ->whereColumn('films_genres.film_id', 'films.id');
            })
            ->delete();

        Genre::query()
            ->where('id', $genre)
            ->delete();
        
        return redirect()->route('admin.films.genres');
    }
}
