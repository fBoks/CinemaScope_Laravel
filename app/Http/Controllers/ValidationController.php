<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Rules\Phone;

class ValidationController extends Controller
{
    public function store(Request $request) {

        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['nullable', 'string', 'max:50'],
            'age' => ['nullable', 'integer', 'min:18', 'max:100'],
            'amount' => ['required', 'numeric', 'min:1', 'max:999999'],
            'gender' => ['nullable', 'string', 'in:male,female'],
            'zip' => ['require', 'digits:6'],
            'subscription' => ['nullable', 'boolean'],
            'agreement' => ['accepted'],
            'password' => ['required', 'string', 'min:7', 'confirmed'],
            'current_password' => ['required', 'string', 'current_password'],
            'email' => ['required', 'string', 'email', 'max:100', 'exists:users'],
            'email_register' => ['required', 'string', 'email', 'max:100', 'unique:users,email'],
            'country_id' => ['required', 'integer', 'exists:countries,id'],
            // 'country_id' => ['required', 'integer', Rule::exists('countries', 'id')->where('active', true)],
            'phone' => ['required', 'string', 'unique:users,phone'],
            // 'phone' => ['required', 'string', new Phone, Rule::unique('users', 'phone')->ignore($user->id)],
            'uuid' => ['nullable', 'string', 'uuid'],
            'ip' => ['nullable', 'string', 'ip'],
            'avatar' => ['required', 'file', 'image', 'max:1024'], // 1024 KB == 1 MB
            'birth_date' => ['nullable', 'string', 'date'],
            'start_date' => ['required', 'string', 'date', 'after_or_equal:today'],
            'finish_date' => ['required', 'string', 'date', 'after:start_date'],
            'services' => ['nullable', 'array', 'min:1', 'max:10'],
            'services.*' => ['required', 'integer'],
            'delivery' => ['required', 'array', 'size:2'], // ['date' => '2021-10-09', 'time' => '12:30:00']
            'delivery.date' => ['required', 'string', 'date_format:Y.m.d'], // 2021-10-09
            'delivery.time' => ['required', 'string', 'date_format:H:i:s'], // 12:30:00

        ]);

        dd($validated);
    }
}
