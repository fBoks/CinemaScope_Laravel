<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CinemaWorkersRole extends Model
{
    use HasFactory;

    protected $fillable = [
        'cinema_w_id', 'cinema_i_role_id',
    ];
}
