<x-layout>
    <x-slot name="title">Редактирование профиля</x-slot>

    <link rel="stylesheet" href="{{ asset('css/profile/edit.css') }}">

    <div class="edit-profile-container">
        <div class="back-link">
            <a href="{{ route('profile.show', auth()->user()) }}" class="btn-back">← Назад к профилю</a>
        </div>

        @if(session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif

        <h1 class="edit-title">Редактирование профиля</h1>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="edit-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label">Аватар</label>
                <div class="avatar-upload">
                    <div class="avatar-preview">
                        @if(auth()->user()->avatar)
                            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}">
                        @else
                            <span class="avatar-letter">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                        @endif
                    </div>
                    <input type="file" name="avatar" accept="image/*" class="avatar-input">
                    @error('avatar')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="name">Имя</label>
                <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" class="form-input">
                @error('name')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" class="form-input">
                @error('email')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="bio">О себе</label>
                <textarea name="bio" id="bio" rows="4" class="form-input" placeholder="Расскажите о себе...">{{ old('bio', auth()->user()->bio) }}</textarea>
                @error('bio')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <h2 class="section-title">Сменить пароль</h2>

            <div class="form-group">
                <label class="form-label" for="current_password">Текущий пароль</label>
                <input type="password" name="current_password" id="current_password" class="form-input">
                @error('current_password')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Новый пароль</label>
                <input type="password" name="password" id="password" class="form-input">
                @error('password')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="password_confirmation">Подтвердите пароль</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-input">
            </div>

            <button type="submit" class="btn-submit">Сохранить изменения</button>
        </form>
    </div>
</x-layout>