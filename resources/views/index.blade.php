<x-layout>
    <section class="hero">
        <div class="hero-inner">
            <div class="hero-left">
                <h1>
                    <span class="accent">BookClub</span><br>
                    Чтение как новая реальность
                </h1>

                <p>
                    Винтажная эстетика и современный подход. 
                    Открывай книги, делись мыслями и находи людей, 
                    которые чувствуют так же.
                </p>

                <div class="hero-actions">
                    @guest
                        <a href="/register" class="btn btn-primary">Начать</a>
                    @endguest
                    <a href="/books" class="btn btn-ghost">Каталог</a>
                    <a href="{{ route('book.create') }}" class="btn btn-ghost">Загрузить свою книгу</a>
                </div>
            </div>

            <div class="hero-right">
                <div class="glass-card">
                    <div class="glow"></div>
                    <p>📖 {{ \App\Models\Book::count() }} книг</p>
                    <p>⭐ {{ \App\Models\Review::count() }} отзывов</p>
                    <p>👥 {{ \App\Models\User::count() }} читателей</p>
                </div>
            </div>
        </div>
    </section>

    <section class="features">
        <div class="features-grid">
            <div class="feature">
                <div class="icon">📚</div>
                <h3>Живая библиотека</h3>
                <p>Книги, которые растут вместе с сообществом.</p>
            </div>
            <div class="feature">
                <div class="icon">🧠</div>
                <h3>Глубокие рецензии</h3>
                <p>Не просто оценки — мысли, которые остаются.</p>
            </div>
            <div class="feature">
                <div class="icon">🌐</div>
                <h3>Связи</h3>
                <p>Находи людей с тем же взглядом на мир.</p>
            </div>
        </div>
    </section>

    <section class="cta">
        <div class="cta-inner">
            @guest
                <h2>Войти в поток чтения</h2>
                <p>Создай аккаунт и начни формировать свой мир</p>
                <a href="/register" class="home-btn-primary">Создать аккаунт</a>
            @endguest
            @auth
                <h2>С возвращением!</h2>
                <p>Продолжай читать, рецензировать и обсуждать</p>
                <a href="{{ route('profile.show', auth()->user()) }}" class="home-btn-primary">Мой профиль</a>
            @endauth
        </div>
    </section>

</x-layout>