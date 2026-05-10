<link rel="stylesheet" href="{{ asset('css/auth/auth.css') }}">

<x-layout>
    <x-slot name="title">Регистрация</x-slot>

    <div class="auth-container">
        <h2 class="auth-title">Регистрация в BookClub</h2>

        <form method="POST" action="{{ route('register') }}" class="auth-form" enctype="multipart/form-data">
            @csrf

            <div class="auth-field">
                <label for="avatar" class="auth-label">Аватар</label>
                <input type="file" name="avatar" id="avatar" class="auth-input" accept="image/*">
                @error('avatar')
                    <p class="auth-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="auth-field">
                <label for="name" class="auth-label">Имя</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="auth-input" required autofocus>
                @error('name')
                    <p class="auth-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="auth-field">
                <label for="email" class="auth-label">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" class="auth-input" required>
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

            <div class="auth-field">
                <label for="password_confirmation" class="auth-label">Подтверждение пароля</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="auth-input" required>
            </div>

            <button type="submit" class="auth-submit">Зарегистрироваться</button>

            <p class="auth-link">
                Уже есть аккаунт? <a href="{{ route('login') }}">Войти</a>
            </p>

            <p class="auth-link">
                <a href="#">Забыли пароль?</a>
            </p>
        </form>
    </div>
</x-layout>