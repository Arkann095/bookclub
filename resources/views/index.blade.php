<x-layout>
    <section class="hero">
        <div class="hero-inner">
            <div class="hero-left">
                <h1>
                    <span class="accent">BookClub</span><br>
                    {{ __('Reading as a new reality') }}
                </h1>

                <p>
                    {{ __('Vintage aesthetics and modern approach. Discover books, share thoughts and find people who feel the same.') }}
                </p>

                <div class="hero-actions">
                    @guest
                        <a href="/register" class="btn btn-primary">{{ __('Get Started') }}</a>
                    @endguest
                    <a href="/books" class="btn btn-ghost">{{ __('Catalog') }}</a>
                    @auth
                        <a href="{{ route('book.create') }}" class="btn btn-ghost">{{ __('Download My Book') }}</a>
                    @endauth
                </div>
            </div>

            <div class="hero-right">
                <div class="glass-card">
                    <div class="glow"></div>
                    @php
                        $booksCount = \Illuminate\Support\Facades\Cache::remember('books_count', 3600, function () {
                            return \App\Models\Book::count();
                        });

                        $reviewsCount = \Illuminate\Support\Facades\Cache::remember('reviews_count', 3600, function () {
                            return \App\Models\Review::count();
                        });

                        $usersCount = \Illuminate\Support\Facades\Cache::remember('users_count', 3600, function () {
                            return \App\Models\User::count();
                        });
                    @endphp
                    <p>📖 {{ $booksCount }} {{ __('Books Count') }}</p>
                    <p>⭐ {{ $reviewsCount }} {{ __('Reviews Count') }}</p>
                    <p>👥 {{ $usersCount }} {{ __('Users Count') }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="features">
        <div class="features-grid">
            <div class="feature">
                <div class="icon">📚</div>
                <h3>{{ __('Living Library') }}</h3>
                <p>{{ __('Books that grow with the community.') }}</p>
            </div>
            <div class="feature">
                <div class="icon">🧠</div>
                <h3>{{ __('Deep Reviews') }}</h3>
                <p>{{ __('Not just ratings — thoughts that stay.') }}</p>
            </div>
            <div class="feature">
                <div class="icon">🌐</div>
                <h3>{{ __('Connections') }}</h3>
                <p>{{ __('Find people with the same worldview.') }}</p>
            </div>
        </div>
    </section>

    <section class="cta">
        <div class="cta-inner">
            @guest
                <h2>{{ __('Join the Reading Flow') }}</h2>
                <p>{{ __('Create an account and start shaping your world') }}</p>
                <a href="/register" class="home-btn-primary">{{ __('Create Account') }}</a>
            @endguest
            @auth
                <h2>{{ __('Welcome Back') }}</h2>
                <p>{{ __('Keep reading, reviewing, and discussing') }}</p>
                <a href="{{ route('profile.show', auth()->user()) }}" class="home-btn-primary">{{ __('My Profile') }}</a>
            @endauth
        </div>
    </section>

</x-layout>