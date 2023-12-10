<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilmsLike extends Model
{
    use HasFactory;

    protected $fillable = [
        'film_id', 
        'user_id',
        'like',
    ];
}
