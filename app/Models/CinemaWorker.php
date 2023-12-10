<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CinemaWorker extends Model
{
    use HasFactory;

    public $customAttribute;

    public function setRoles($roles)
    {
        $this->attributes['roles'] = $roles;
    }

    protected $fillable = [
        'first_name', 'surname',
    ];
}
