<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilmsGenre extends Model
{
    use HasFactory;

    public $customAttribute;

    public function setGenres($genres)
    {
        $this->attributes['genres'] = $genres;
    }

    protected $fillable = [
        'film_id', 'genre_id'
    ];
}
