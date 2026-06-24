<x-layout>
    <x-slot name="title">Забыли пароль?</x-slot>
    
    <div class="forgot-container">
        <div class="forgot-card">
            <div class="forgot-header">
                <h1 class="forgot-title">Забыли пароль?</h1>
                <p class="forgot-subtitle">Введите ваш email, и мы отправим ссылку для сброса пароля</p>
            </div>

            @if(session('status'))
                <div class="flash-message flash-success">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('password.email') }}" method="POST" class="forgot-form">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-input" placeholder="Введите ваш email" required autofocus>
                    @error('email')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn-submit">Отправить ссылку</button>
            </form>

            <div class="forgot-footer">
                <a href="{{ route('login') }}" class="forgot-link">← Вспомнили пароль? Войти</a>
            </div>
        </div>
    </div>
</x-layout>