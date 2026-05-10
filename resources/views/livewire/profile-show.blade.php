{{-- resources/views/livewire/profile-show.blade.php --}}
<div>
    <link rel="stylesheet" href="{{ asset('css/profile/show.css') }}">

    <section class="profile-hero">
        <div class="container profile-hero-inner">
            
            <div class="profile-avatar">
                @if($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}">
                @else
                    <span class="profile-avatar-letter">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                @endif
            </div>

            <div class="profile-info">
                <h1 class="profile-name">{{ $user->name }}</h1>
                
                @if($user->bio)
                    <p class="profile-bio">{{ $user->bio }}</p>
                @endif

                <div class="profile-stats">
                    <div class="stat">
                        <span class="stat-value">{{ $reviews->count() }}</span>
                        <span class="stat-label">рецензий</span>
                    </div>
                    <div class="stat">
                        <span class="stat-value">{{ $comments->count() }}</span>
                        <span class="stat-label">комментариев</span>
                    </div>
                    <div class="stat">
                        <span class="stat-value">{{ $followers->count() }}</span>
                        <span class="stat-label">подписчиков</span>
                    </div>
                    <div class="stat">
                        <span class="stat-value">{{ $following->count() }}</span>
                        <span class="stat-label">подписок</span>
                    </div>
                </div>

                @auth
                    @if($isOwner)
                        <a href="/profile/edit" class="btn-edit">Редактировать профиль</a>
                    @else
                        <button wire:click="toggleFollow" class="btn-follow {{ $isFollowing ? 'following' : '' }}">
                            {{ $isFollowing ? '✓ Вы подписаны' : '+ Подписаться' }}
                        </button>
                    @endif
                @endauth
            </div>

        </div>
    </section>

    <div class="container profile-content">

    <div class="profile-tabs">
        <button class="tab {{ $activeTab === 'reviews' ? 'active' : '' }}" wire:click="$set('activeTab', 'reviews')">Рецензии</button>
        <button class="tab {{ $activeTab === 'comments' ? 'active' : '' }}" wire:click="$set('activeTab', 'comments')">Комментарии</button>
        @if($isOwner)
            <button class="tab {{ $activeTab === 'notifications' ? 'active' : '' }}" wire:click="$set('activeTab', 'notifications')">Уведомления</button>
        @endif
        <button class="tab {{ $activeTab === 'books' ? 'active' : '' }}" wire:click="$set('activeTab', 'books')">
            Мои книги
        </button>
    </div>
        <a href="{{ route('profile.followers', $user) }}" class="btn-followers">
          Управление подписчиками
        </a>
        @if($activeTab === 'reviews')
            <div class="reviews-list">
                @forelse($reviews as $review)
                    <div class="review-card">
                        <div class="review-book">
                            <div class="review-book-cover">
                                @if($review->book->cover_image)
                                    <img src="{{ asset('storage/' . $review->book->cover_image) }}" alt="{{ $review->book->title }}">
                                @else
                                    <span class="review-book-letter">{{ strtoupper(substr($review->book->title, 0, 1)) }}</span>
                                @endif
                            </div>
                            <div class="review-book-info">
                                <a href="{{ route('books.show', $review->book) }}" class="review-book-title">
                                    {{ $review->book->title }}
                                </a>
                                <span class="review-book-author">{{ $review->book->author }}</span>
                            </div>
                        </div>

                        <div class="review-content">
                            <div class="review-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $review->rating)
                                        ★
                                    @else
                                        ☆
                                    @endif
                                @endfor
                            </div>
                            <p class="review-text">{{ $review->body }}</p>
                            <time class="review-date">{{ $review->created_at->format('d.m.Y') }}</time>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <div class="empty-icon">📝</div>
                        <p>Пока нет рецензий</p>
                    </div>
                @endforelse
            </div>
        @endif

        @if($activeTab === 'comments')
            <div class="comments-list">
                @forelse($comments as $comment)
                    <div class="comment-card">
                        <a href="{{ route('books.show', $comment->book) }}" class="comment-book-title">
                            «{{ $comment->book->title }}»
                        </a>
                        <p class="comment-text">{{ $comment->body }}</p>
                        <time class="comment-date">{{ $comment->created_at->format('d.m.Y') }}</time>
                    </div>
                @empty
                    <div class="empty-state">
                        <div class="empty-icon">💬</div>
                        <p>Пока нет комментариев</p>
                    </div>
                @endforelse
            </div>
        @endif

        @if($activeTab === 'notifications' && $isOwner)
            <div class="notifications-list">
                <p class="text-muted">Уведомления появятся позже</p>
            </div>
        @endif

    </div>
</div>