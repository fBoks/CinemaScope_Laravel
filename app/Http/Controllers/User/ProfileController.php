<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index() {
        $user = User::query()->findOrFail(Auth::id());

        return view('user.profile.index', compact('user'));
    }

    public function update(Request $request, string $user_id) {
        $email = $request->validate(['email' => ['required', 'string', 'email']]);
        $emailIsActual = $email['email'] == Auth::user()->email;
        
        $emailRule = '';
        if(! $emailIsActual) {
            $emailRule = 'unique:users,email';
        }

        $validated = $request->validate([
            'password' => ['required', 'string', 'min:7', 'max:50'],
            'password_new' => ['nullable', 'string', 'min:7', 'max:50'],
            'email' => ['required', 'string', 'max:50', 'email', $emailRule],
        ]);

        if(! Hash::check($validated['password'], Auth::user()->password)) {
            return back()->withErrors([
                'password' => 'Неверный пароль'
            ]);
        }

        $query = User::query()->where('id', $user_id);

        $query->update([
            'email' => $validated['email']
        ]);

        if($password_new = Hash::make($validated['password_new']) ?? null) {
            $query->update([
                'password' => $password_new
            ]);
        }

        alert(__('Изменения сохранены!'));
        return redirect()->route('user.profile', $user_id);
    }
}
