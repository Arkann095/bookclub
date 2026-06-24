<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
        'email' => ['required', 'email', 'exists:users,email'],
        ], [
            'email.required' => 'Введите email',
            'email.email' => 'Введите корректный email',
            'email.exists' => 'Пользователь с таким email не найден',
        ]);

        $status = Password::sendResetLink($request->only('email'));
        
        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', 'Ссылка для сброса пароля отправлена на ваш email');
        } elseif ($status === Password::INVALID_USER) {
            return back()->withErrors(['email' => 'Пользователь с таким email не найден']);
        } elseif ($status === Password::RESET_THROTTLED) {
            return back()->withErrors(['email' => 'Слишком много попыток. Попробуйте позже']);
        } else {
            return back()->withErrors(['email' => 'Не удалось отправить ссылку']);
        }
    }
}
