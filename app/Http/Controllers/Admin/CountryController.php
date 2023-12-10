<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use App\Models\Country;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:50'],
        ]);

        $query = Country::query();

        // <Запросы для фильтров>
        if ($search = $validated['search'] ?? null) {
            $query->where('countries.name', 'like', "%{$search}%");
        }

        $countries = $query
            ->orderBy('name')
            ->paginate(10);

        return view('admin.countries.index', compact('countries'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'search' => ['required', 'string', 'unique:countries,name'],
        ]);

        Country::query()->insert(['name' => $validated['search']]);

        alert(__("Страна {$validated['search']} успешно добавлена!"));
        return redirect()->route('admin.countries');
    }

    public function delete(string $country)
    {
        Film::query()
            ->whereExists(function (Builder $query) use ($country) {
                $query->select('*')
                    ->from('films_countries')
                    ->where('films_countries.country_id', $country)
                    ->whereColumn('films_countries.film_id', 'films.id');
            })
            ->delete();

        Country::query()
            ->where('id', $country)
            ->delete();

        return redirect()->route('admin.countries');
    }
}
