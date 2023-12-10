<?php

use Illuminate\Support\Facades\Route;

if (! function_exists('active_link')) {
    function active_link(string $name, string $active = 'active') : string {
        return Route::is($name) ? $active : '';
    }
}

if (!function_exists('alert')) {
    function alert(string $value, string $alertType = 'success') {
        session()->flash('alert', $value);
        session()->flash('alertType', 'alert-'.$alertType);
    }
}

if(!function_exists('getFilmCreator')) {
    function getFilmCreator($qeury, $film_id, $creator) {
        return $qeury
            ->whereRaw("cir.name_eng = '{$creator}'")
            ->selectRaw("CONCAT(cw.first_name,' ',cw.surname) as {$creator}")
            ->first($film_id);
    }
}