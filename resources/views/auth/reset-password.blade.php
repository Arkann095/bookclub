<x-layout>
    <x-slot name="title">Сброс пароля</x-slot>

    <div class="reset-container">
        <div class="reset-card">
            <div class="reset-header">
                <h1 class="reset-title">Новый пароль</h1>
                <p class="reset-subtitle">Придумайте новый пароль для вашего аккаунта</p>
            </div>

            <form action="{{ route('password.update') }}" method="POST" class="reset-form">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $email ?? '') }}" class="form-input" placeholder="Введите ваш email" required readonly onfocus="this.removeAttribute('readonly')">
                    @error('email')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Новый пароль</label>
                    <input type="password" name="password" id="password" class="form-input" placeholder="Не менее 8 символов" required>
                    @error('password')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Подтвердите пароль</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-input" placeholder="Повторите пароль" required>
                    @error('password_confirmation')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn-submit">Сохранить пароль</button>
            </form>
        </div>
    </div>
</x-layout>