<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Http\Requests\RegisterRequest;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    
    public function store(RegisterRequest $request) {

         $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => $request->hasFile('avatar')
            ? $request->file('avatar')->store('avatars', 'public')
            : null,
        ]);

        Auth::login($user);

        return redirect('/')->with('success', 'Добро пожаловать в BookClub!');
    }
}

    

