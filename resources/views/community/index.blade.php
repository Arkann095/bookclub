<link rel="stylesheet" href="{{ asset('css/community/community.css') }}">
<x-layout>
    <section class="community-hero">
        <div class="container">
            <h1 class="community-hero-title">
                Сообщество
            </h1>
            <p class="community-hero-text">
                Люди, которые читают. Находи единомышленников, следи за рецензиями и обсуждай книги
            </p>
        </div>
    </section>

    <div class="container community-layout">

        <div class="community-main">

            <div class="community-section-header">
                <h2 class="community-section-title">
                    🌟 Последние рецензии
                </h2>
            </div>

            @forelse($activities as $activity)
                <div class="activity-card">
                    <div class="activity-icon">📝</div>
                    
                    <div class="activity-body">
                        <a href="{{ route('profile.show', $activity->user->id) }}">
                            <div class="activity-user-row">
                                <div class="activity-avatar">
                                    @if($activity->user->avatar)
                                        <img src="{{ asset('storage/' . $activity->user->avatar) }}" alt="{{ $activity->user->name }}">
                                    @else
                                        <span class="activity-avatar-letter">{{ strtoupper(substr($activity->user->name, 0, 1)) }}</span>
                                    @endif
                                </div>
                                <strong class="activity-username">{{ $activity->user->name }}</strong>
                            </div>
                        </a>

                        <p class="activity-text">
                            написал(а) рецензию на книгу
                            <a href="{{ route('books.show', $activity->book->id) }}" class="activity-link">
                                «{{ $activity->book->title }}»
                            </a>
                            @if($activity->rating)
                                <span class="activity-stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $activity->rating)
                                            ★
                                        @else
                                            ☆
                                        @endif
                                    @endfor
                                </span>
                            @endif
                        </p>

                        @if($activity->body)
                            <p class="activity-comment-preview">
                                «{{ Str::limit($activity->body, 120) }}»
                            </p>
                        @endif

                        <time class="activity-time">
                            {{ $activity->created_at->diffForHumans() }}
                        </time>
                    </div>
                </div>
            @empty
                <div class="activity-empty">
                    <div class="activity-empty-icon">📭</div>
                    <h3>Пока тихо</h3>
                    <p>Здесь будут появляться рецензии читателей</p>
                </div>
            @endforelse

        </div>

        <aside class="community-sidebar">

            <div class="sidebar-widget">
                <h3 class="sidebar-widget-title">🏆 Топ читателей</h3>
                <div class="top-readers">
                    @foreach($topReaders as $index => $reader)
                        <div class="top-reader-item">
                            <span class="top-reader-rank">#{{ $index + 1 }}</span>

                            <div class="top-reader-avatar">
                                <a href="{{ route('profile.show', $reader) }}">
                                    @if($reader->avatar)
                                        <img class="avatar-sm" src="{{ asset('storage/' . $reader->avatar) }}" alt="{{ $reader->name }}>
                                    @else
                                        <span class="top-reader-avatar-letter">{{ strtoupper(substr($reader->name, 0, 1)) }}</span>
                                    @endif
                                </a>
                            </div>

                            <div class="top-reader-info">
                                <strong class="top-reader-name">{{ $reader->name }}</strong>
                                <span class="top-reader-stats">
                                    {{ $reader->reviews_count }} {{ trans_choice('рецензия|рецензии|рецензий', $reader->reviews_count) }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="sidebar-widget">
                <h3 class="sidebar-widget-title">💬 Сейчас обсуждают</h3>
                <div class="discussions">
                    @foreach($popularBooks as $book)
                        <a href="{{ route('books.show', $book) }}" class="discussion-item">
                            <div class="discussion-cover">
                                @if($book->cover_image)
                                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}">
                                @else
                                    <span class="discussion-cover-letter">{{ strtoupper(substr($book->title, 0, 1)) }}</span>
                                @endif
                            </div>
                            <div class="discussion-info">
                                <strong class="discussion-title">{{ $book->title }}</strong>
                                <span class="discussion-count">
                                    {{ $book->comments_count }} {{ trans_choice('комментарий|комментария|комментариев', $book->comments_count) }}
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            @guest
                <div class="sidebar-widget sidebar-cta">
                    <h3 class="sidebar-cta-title">Присоединяйся!</h3>
                    <p class="sidebar-cta-text">Оставляй рецензии, обсуждай книги и находи друзей по чтению</p>
                    <a href="/register" class="sidebar-cta-btn">Создать аккаунт</a>
                </div>
            @endguest

            {{ $activities->links() }}
        </aside>
    </div>
</x-layout>