<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CinemaWorkersFilms extends Model
{
    use HasFactory;

    protected $fillable = [
        'cinema_worker_role_id', 'film_id',
    ];
}
