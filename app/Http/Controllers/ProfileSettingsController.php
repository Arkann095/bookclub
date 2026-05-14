<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use App\Models\User;

class ProfileSettingsController extends Controller
{
    
    public function update(Request $request) {

    $validated = $request->validate([
        'avatar' => ['nullable', 'image', 'max:2048'],
        'name' => ['required', 'string', 'max:18'],
        'email' => ['bail', 'required', 'email', 'unique:users,email,' . auth()->id()],
        'bio' => ['nullable', 'string', 'max:500'],
        'password' => ['nullable', 'min:8', 'confirmed', 'regex:/[0-9]/', 'regex:/[A-Z]/'],
    ], [
        'avatar.image' => 'Файл должен быть изображением',
        'avatar.max' => 'Размер аватара не должен превышать 2 МБ',
        'name.required' => 'Имя обязательно для заполнения',
        'name.max' => 'Имя не должно быть длиннее 18 символов',
        'email.required' => 'Email обязателен для заполнения',
        'email.email' => 'Введите корректный email',
        'email.unique' => 'Этот email уже занят',
        'bio.max' => 'Описание не должно быть длиннее 500 символов',
        'password.min' => 'Пароль должен быть не короче 8 символов',
        'password.confirmed' => 'Пароли не совпадают',
        'password.regex' => 'Пароль должен содержать хотя бы одну цифру и заглавную букву',
    ]);

        if($request->hasFile('avatar')) {
            if (auth()->user()->avatar) {
                Storage::disk('public')->delete(auth()->user()->avatar);
            }

            $path = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $path;
        }

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user = auth()->user();

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'bio' => $validated['bio'],
            'avatar' => $validated['avatar'] ?? $user->avatar,
        ]);

        return back()->with('success', 'Профиль обновлён');

    }

}
