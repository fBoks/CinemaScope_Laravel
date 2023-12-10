<?php

namespace App\Http\Controllers\Admin\Films;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\CinemaIndustryRole;
use App\Models\CinemaWorker;
use App\Models\CinemaWorkersRole;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;

class CinemaWorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:50'],
        ]);

        $query = CinemaWorker::query();

        // <Запросы для фильтров>
        if ($search = $validated['search'] ?? null) {
            $query
                ->where('cinema_workers.first_name', 'like', "%{$search}%")
                ->orWhere('cinema_workers.surname', 'like', "%{$search}%");
        }

        $searchedRoles = CinemaWorkersRole::query();
        if ($role_id = $request->role_id ?? null) {
            $searchedRoles
                ->where('cinema_i_role_id', '=', $role_id)
                ->select('cinema_w_id');

            $query->whereIn('id', $searchedRoles);
        }

        $workers = $query->orderBy('cinema_workers.first_name')->paginate(10);

        foreach ($workers as $worker) {

            $roles = CinemaWorkersRole::query()
                ->where('cinema_w_id', $worker->id)
                ->join('cinema_industry_roles', 'cinema_industry_roles.id', '=', 'cinema_workers_roles.cinema_i_role_id')
                ->orderBy('cinema_industry_roles.name')
                ->get('cinema_industry_roles.name');

            $worker->setRoles($roles);

        }

        $roles = CinemaIndustryRole::query()->orderBy('name')->get();

        return view('admin.films.workers.index', compact('workers', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = CinemaIndustryRole::query()->get();

        return view('admin.films.workers.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'surname' => ['required', 'string', 'max:50'],
            'first_name' => ['required', 'string', 'max:50'],
            'roles' => ['required'],
        ]);

        $worker = CinemaWorker::query()
            ->create([
                'surname' => $validated['surname'],
                'first_name' => $validated['first_name'],
            ]);
            
        foreach($validated['roles'] as $role) {
            CinemaWorkersRole::query()
                ->create([
                    'cinema_w_id' => $worker->id,
                    'cinema_i_role_id' => $role,
                ]);
        }

        return redirect()->route('admin.films.workers');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $worker)
    {
        $query = CinemaWorker::query();

        $worker = $query
            ->where('id', $worker)
            ->selectRaw("CONCAT(first_name,' ',surname) as name")
            ->findOrFail($worker);

        return view('admin.films.workers.show', compact('worker'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $worker = CinemaWorker::query()->findOrFail($id);

        $roles = CinemaIndustryRole::query()->get();

        $selected_roles = CinemaWorkersRole::query()
            ->where('cinema_w_id', $id)
            ->get();

        return view('admin.films.workers.edit', compact('worker', 'roles', 'selected_roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $worker_id)
    {
        $validated = $request->validate([
            'surname' => ['required', 'string', 'max:50'],
            'first_name' => ['required', 'string', 'max:50'],
            'roles' => ['required'],
        ]);

        CinemaWorker::query()
            ->where('id', $worker_id)
            ->update(['surname' => $validated['surname'],
                    'first_name' => $validated['first_name'], 
                ]);

        CinemaWorkersRole::query()
                ->where('cinema_w_id', $worker_id)
                ->delete();

        foreach($validated['roles'] as $role) {
            CinemaWorkersRole::query()
                ->create([
                        'cinema_w_id' => $worker_id,
                        'cinema_i_role_id' => $role,
                    ]);
        }

        return redirect()->route('admin.films.workers');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $worker)
    {
        Film::query()
            ->whereExists(function (Builder $query) use ($worker) {
                $query->select('*')
                    ->from('cinema_workers_films')
                    ->join('cinema_workers_roles', 'cinema_workers_roles.id', '=', 'cinema_workers_films.cinema_worker_role_id')
                    ->where('cinema_workers_roles.cinema_w_id', $worker)
                    ->whereColumn('cinema_workers_films.film_id', 'films.id');
            })
            ->delete();

        CinemaWorker::query()
            ->where('id', $worker)
            ->delete();

        return redirect()->route('admin.films.workers');
    }
}
