<x-layout>
    <x-slot name="title">Подтверждение email</x-slot>

    <link rel="stylesheet" href="{{ asset('css/auth/verify-email.css') }}">

    <div class="verify-container">
        <div class="verify-card">
            <div class="verify-icon">✉️</div>
            <h1 class="verify-title">Подтвердите ваш email</h1>
            <p class="verify-text">
                Мы отправили письмо на <strong>{{ auth()->user()->email }}</strong>.
                Перейдите по ссылке в письме чтобы подтвердить аккаунт.
            </p>
            <p class="verify-hint">Не получили письмо? Проверьте папку "Спам" или запросите новое.</p>

            <form action="{{ route('verification.send') }}" method="POST">
                @csrf
                <button type="submit" class="btn-verify">Отправить повторно</button>
            </form>

            @if(session('success'))
                <div class="flash-message flash-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>
</x-layout>