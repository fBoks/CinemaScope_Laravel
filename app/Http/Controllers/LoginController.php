<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if(Auth::check()) {
            alert(__('Вы уже авторизованы'), 'info');
            return redirect()->route('user.posts');
        }

        return view('login.index');
    }

    public function store(Request $request)
    {
        // dd($request->remember);
        $validated = $request->validate([
            'login' => ['required', 'string', 'max:50'],
            'password' => ['required', 'string', 'min:7', 'max:50'],
        ]);

        $remember = $request->remember ? true : false;

        if (Auth::attempt($validated, $remember)) {
            $request->session()->regenerate();

            alert(__('Добро пожаловать!'));
            return redirect()->route('user.posts');
        }
        
        return back()->withErrors([
            'login' => 'Неверный логин или пароль'
        ])->onlyInput('login');
    }
}
