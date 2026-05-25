{{-- resources/views/api.blade.php --}}
<x-layout>
    <x-slot name="title">API</x-slot>

    <link rel="stylesheet" href="{{ asset('css/api.css') }}">

    <section class="api-hero">
        <div class="container">
            <h1 class="api-title">API BookClub</h1>
            <p class="api-subtitle">Доступ к данным платформы в формате JSON для разработчиков</p>
        </div>
    </section>

    <div class="container api-content">
        <div class="api-card">
            <div class="api-section">
                <h3>Авторизация</h3>
                <p>API использует токены Laravel Sanctum. Для получения токена отправьте POST-запрос:</p>
                <div class="code-block">
                    <code>POST /api/tokens/create</code>
                </div>
                <p>Передайте <strong>email</strong> и <strong>password</strong> в теле запроса. В ответе получите токен.</p>
                <p>Все защищённые запросы требуют заголовок:</p>
                <div class="code-block">
                    <code>Authorization: Bearer ваш_токен</code>
                </div>
            </div>

            <div class="api-section">
                <h3>Книги</h3>
                <div class="endpoint">
                    <span class="method method-get">GET</span>
                    <code class="endpoint-url">/api/books</code>
                    <span class="endpoint-desc">Список всех книг</span>
                </div>
                <div class="endpoint">
                    <span class="method method-get">GET</span>
                    <code class="endpoint-url">/api/books/{id}</code>
                    <span class="endpoint-desc">Одна книга по ID</span>
                </div>
                <div class="endpoint">
                    <span class="method method-get">GET</span>
                    <code class="endpoint-url">/api/books/{id}/reviews</code>
                    <span class="endpoint-desc">Рецензии к книге</span>
                </div>
                <div class="endpoint">
                    <span class="method method-get">GET</span>
                    <code class="endpoint-url">/api/books/{id}/comments</code>
                    <span class="endpoint-desc">Комментарии к книге</span>
                </div>
                <div class="endpoint">
                    <span class="method method-post">POST</span>
                    <code class="endpoint-url">/api/books</code>
                    <span class="endpoint-desc">Добавить книгу (требуется токен)</span>
                </div>
            </div>

            <div class="api-section">
                <h3>Пользователи</h3>
                <div class="endpoint">
                    <span class="method method-get">GET</span>
                    <code class="endpoint-url">/api/users/{id}</code>
                    <span class="endpoint-desc">Профиль пользователя</span>
                </div>
                <div class="endpoint">
                    <span class="method method-get">GET</span>
                    <code class="endpoint-url">/api/users/{id}/reviews</code>
                    <span class="endpoint-desc">Рецензии пользователя</span>
                </div>
            </div>

            <div class="api-section">
                <h3>Рецензии</h3>
                <div class="endpoint">
                    <span class="method method-post">POST</span>
                    <code class="endpoint-url">/api/books/{id}/reviews</code>
                    <span class="endpoint-desc">Оставить рецензию (требуется токен)</span>
                </div>
            </div>

            <div class="api-footer">
                <p>По вопросам интеграции: <a href="https://github.com/Arkann095" target="_blank">GitHub</a></p>
            </div>
        </div>
    </div>
</x-layout>