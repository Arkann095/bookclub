<link rel="stylesheet" href="{{ asset('css/auth/auth.css') }}">

<x-layout>
    <x-slot name="title">Вход</x-slot>

    <div class="auth-container">
        <h2 class="auth-title">Вход в BookClub</h2>

        <form method="POST" action="{{ route('login') }}" class="auth-form">
            @csrf

            <div class="auth-field">
                <label for="email" class="auth-label">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" class="auth-input" required autofocus>
                @error('email')
                    <p class="auth-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="auth-field">
                <label for="password" class="auth-label">Пароль</label>
                <input type="password" name="password" id="password" class="auth-input" required>
                @error('password')
                    <p class="auth-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="auth-field" style="display: flex; align-items: center; gap: 10px;">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember" style="font-weight: 400; cursor: pointer;">Запомнить меня</label>
            </div>

            <button type="submit" class="auth-submit">Войти</button>

            <p class="auth-link">
                <a href="#">Забыли пароль?</a>
            </p>

            <p class="auth-link">
                Нет аккаунта? <a href="{{ route('register') }}">Зарегистрироваться</a>
            </p>
        </form>
    </div>
</x-layout>