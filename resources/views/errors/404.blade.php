
<x-layout>
    <x-slot name="title">Страница не найдена</x-slot>

    <link rel="stylesheet" href="{{ asset('css/errors/404.css') }}">

    <div class="error-page">
        <div class="error-animation">
            <div class="book">
                <div class="book-spine"></div>
                <div class="book-pages">
                    <span class="book-page page-1"></span>
                    <span class="book-page page-2"></span>
                    <span class="book-page page-3"></span>
                </div>
                <div class="book-cover-left"></div>
                <div class="book-cover-right"></div>
            </div>
            
            <div class="bookmark"></div>
        </div>

        <h1 class="error-number">404</h1>
        <p class="error-title">Страница не найдена</p>
        <p class="error-text">
            Эта страница затерялась где-то между страниц книги.<br>
            Возможно, она была удалена или её никогда не существовало.
        </p>
        <a href="/" class="btn-home">← Вернуться на главную</a>
    </div>
</x-layout>