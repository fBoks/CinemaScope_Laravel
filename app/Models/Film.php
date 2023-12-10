<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    public $customAttribute;

    public function setGenres($genres) {
        $this->attributes['genres'] = $genres;
    }

    public function setCountries($countries) {
        $this->attributes['countries'] = $countries;
    }

    public function setCreators($creators) {
        $this->attributes['creators'] = $creators;
    }

    public function setActors($actors)
    {
        $this->attributes['actors'] = $actors;
    }

    protected $fillable = [
        'name', 'tagline', 'description',
        'realised_at',
        'country_id',
    ];

    protected $casts = [
        'realised_at' => 'date',
    ];

   
}
