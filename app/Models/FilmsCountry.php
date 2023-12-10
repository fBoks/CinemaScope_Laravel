<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilmsCountry extends Model
{
    use HasFactory;

    protected $fillable = [
        'film_id',
        'country_id'
    ];
}
