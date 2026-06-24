
<div>
    <!-- шапка профиля -->
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

                @if (!$isProfileHidden || $isOwner)
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
                @else
                    <p class="profile-private-notice">Пользователь скрыл свой профиль</p>
                @endif

                @auth
                    @if($isOwner)
                        <a href="/profile/edit" class="btn-edit">Редактировать профиль</a>
                        <button class="btn-edit" wire:click="$set('isProfileHidden', {{ $isProfileHidden ? 'false' : 'true' }})">
                            {{ $isProfileHidden ? 'Показать профиль' : 'Скрыть профиль' }}
                        </button>
                    @elseif(!$isProfileHidden)
                        <button wire:click="toggleFollow" class="btn-follow {{ $isFollowing ? 'following' : '' }}">
                            {{ $isFollowing ? '✓ Вы подписаны' : '+ Подписаться' }}
                        </button>
                    @endif
                @endauth
            </div>

        </div>
    </section>
    <!-- Проваливаемся если не скрыли профиль и если он твой -->
    @if(!$isProfileHidden || $isOwner)
        <div class="container profile-content">
            <!-- свайпы по вкладкам -->
            <div class="profile-tabs">
                <button class="tab {{ $activeTab === 'reviews' ? 'active' : '' }}" wire:click="$set('activeTab', 'reviews')">Рецензии</button>
                <button class="tab {{ $activeTab === 'comments' ? 'active' : '' }}" wire:click="$set('activeTab', 'comments')">Комментарии</button>
                @if($isOwner)
                    <button class="tab {{ $activeTab === 'notifications' ? 'active' : '' }}"wire:click="$set('activeTab', 'notifications'); markNotificationsAsRead()">Уведомления</button>
                    
                    <button class="tab {{ $activeTab === 'books' ? 'active' : '' }}" wire:click="$set('activeTab', 'books')">
                    Мои книги
                    </button>
                @endif
            </div>
            <!-- управление подписчиками -->
            @if($isOwner)
                <a href="{{ route('profile.followers', $user) }}" class="btn-followers">
                Управление подписчиками
                </a>
            @endif
            <!-- отображение написанных рецензий -->
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
            <!-- отображение написанных комментариев -->
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
            <!-- отображение уведомлений -->
           @if($activeTab === 'notifications' && $isOwner)
                <div class="notifications-list">
                    @forelse($notifications as $notification)
                        @php
                            $data = json_decode($notification->data);
                        @endphp
                        <div class="notification-item">
                            @if($notification->type === 'follow')
                                <a href="{{ route('profile.show', $data->follower_id) }}">
                                    {{ $data->follower_name }} подписался(ась) на вас
                                </a>
                            @else
                                <a href="{{ route('books.show', $data->book_id) }}">
                                    {{ $data->user_name }}
                                    @if($notification->type === 'review')
                                        оставил(а) рецензию на книгу «{{ $data->book_title }}»
                                    @elseif($notification->type === 'comment')
                                        оставил(а) комментарий к книге «{{ $data->book_title }}»
                                    @endif
                                </a>
                            @endif
                            <time>{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</time>
                        </div>
                    @empty
                        <p class="text-muted">Уведомлений пока нет</p>
                    @endforelse
                </div>
            @endif
            <!-- отображение моих книг -->
            @if($activeTab === 'books' && $isOwner)
                <div class="books-list">
                    @forelse($user->books as $book)
                        <div class="book-card-show">
                            <div class="book-card-cover">
                                @if($book->cover_image)
                                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}">
                                @else
                                    <span class="book-card-letter">{{ strtoupper(substr($book->title, 0, 1)) }}</span>
                                @endif
                            </div>
                            <div class="book-card-info">
                                <a href="{{ route('books.show', $book) }}" class="book-card-title">
                                    {{ $book->title }}
                                </a>
                                <span class="book-card-author">{{ $book->author }}</span>
                                <span class="book-card-year">{{ $book->published_year }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <div class="empty-icon">📚</div>
                            <p>Вы ещё не добавили ни одной книги</p>
                        </div>
                    @endforelse
                </div>
            @endif
        </div>
    @endif
</div>