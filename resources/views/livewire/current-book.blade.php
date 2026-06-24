<div>
    <!-- кнопка назад -->
    <div class="back-link">
        <a href="/" class="btn-back">← Назад</a>
    </div>
    <section class="book-hero">
        <div class="container book-hero-inner">
            <!-- обложка -->
            <div class="book-page-cover">
                @if($book->cover_image)
                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}">
                @else
                    <span class="book-cover-letter">{{ strtoupper(substr($book->title, 0, 1)) }}</span>
                @endif
            </div>
            <!-- информация о книге -->
            <div class="book-page-info">
                <h1 class="book-page-title">{{ $book->title }}</h1>
                <a href="{{ route('profile.show', $book->user->id) }}" class="book-page-author">{{ $book->author }}</a>
                <!-- год и ISBN -->
                <div class="book-page-meta">
                    @if($book->published_year)
                        <span class="book-year">{{ $book->published_year }} г.</span>
                    @endif
                    @if($book->isbn)
                        <span class="book-isbn">ISBN: {{ $book->isbn }}</span>
                    @endif
                </div>
                <!-- Если есть описание -->
                @if($book->description)
                    <div class="book-page-description">
                        {{ $book->description }}
                    </div>
                @endif
                <!-- Рейтинг -->
                @php
                    $avgRating = $book->reviews->avg('rating');
                    $reviewsCount = $book->reviews->count();
                @endphp
                <div class="book-rating-block">
                    <div class="stars">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= round($avgRating))
                                ★
                            @else
                                ☆
                            @endif
                        @endfor
                    </div>
                    <span class="rating-value">{{ number_format($avgRating, 1) }}</span>
                    <span class="rating-count">({{ $reviewsCount }} {{ trans_choice('рецензия|рецензии|рецензий', $reviewsCount) }})</span>
                </div>
                <!-- Действия с книгой -->
                @if ($book->book_file)
                    <div class="book-actions {{ auth()->check() ? '' : 'guest-layout' }}">
                        <a href="{{ asset('storage/' . $book->book_file) }}" class="btn-submit">
                            📖 Просмотреть книгу
                        </a>
                        <a href="{{ route('books.download', $book) }}" class="btn-submit">
                            📥 Скачать книгу
                        </a>
                        @auth
                            @if($book->shelves->where('user_id', auth()->id())->count())
                                <span class="btn-added">📚 На полке</span>
                            @else
                                <button wire:click="addToShelf" class="btn-submit">📌 Добавить на полку</button>
                            @endif
                        @endauth
                    </div>
                @else
                    <p class="book-no-content">Автор еще не добавил книгу</p>
                @endif
                <!-- Редактировать книгу -->
                @auth
                    @if(auth()->id() === $book->user_id)
                        <a href="{{ route('books.edit', $book) }}" class="btn-edit">Редактировать книгу</a>
                    @endif
                @endauth
            </div>
        </div>
    </section>
    <!-- Социальная часть -->
    <div class="container book-layout">
        <div class="reviews-section">
            <div class="section-header">
                <h2 class="section-title">Рецензии</h2>
                <span class="section-count">{{ $reviewsCount }}</span>
            </div>
            <!-- Оставить рецензию если авторизирован -->
            @auth
                <div class="review-form">
                    <h3>Оставить рецензию</h3>
                    <form wire:submit="storeReview">
                        <div class="form-group">
                            <p class="form-label">Оценка</p>
                            <div class="rating-input">
                                @for($i = 5; $i >= 1; $i--)
                                    <input type="radio" wire:model="reviewRating" value="{{ $i }}" id="star{{ $i }}">
                                    <label for="star{{ $i }}">★</label>
                                @endfor
                            </div>
                            @error('reviewRating') <span class="form-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="reviewBody">Текст рецензии</label>
                            <textarea wire:model="reviewBody" id="reviewBody" rows="5" placeholder="Расскажите, что вы думаете об этой книге..."></textarea>
                            @error('reviewBody') <span class="form-error">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="btn-submit">Опубликовать</button>
                    </form>
                </div>
                <hr class="divider">
            @endauth
            <!-- Отобразить рецензии -->
            @forelse($book->reviews as $review)
                <div class="review-card">
                    <div class="review-header">
                        <div class="review-user">
                            <div class="avatar-sm">
                                @if($review->user->avatar)
                                    <img src="{{ asset('storage/' . $review->user->avatar) }}" alt="{{ $review->user->name }}">
                                @else
                                    <span class="avatar-letter">{{ strtoupper(substr($review->user->name, 0, 1)) }}</span>
                                @endif
                            </div>
                            <strong class="review-username">{{ $review->user->name }}</strong>
                        </div>

                        <div class="review-stars">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $review->rating)
                                    ★
                                @else
                                    ☆
                                @endif
                            @endfor
                        </div>
                    </div>

                    <p class="review-body">{{ $review->body }}</p>

                    <div class="review-footer">
                        <time class="review-date">{{ $review->created_at->format('d.m.Y') }}</time>
                        @if($review->started_at && $review->finished_at)
                            <span class="review-dates">
                                Читал: {{ $review->started_at->format('d.m.Y') }} — {{ $review->finished_at->format('d.m.Y') }}
                            </span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-icon">📝</div>
                    <p>Пока нет рецензий. Будьте первым!</p>
                </div>
            @endforelse
        </div>
       <!-- Комментарии и ответы -->
        <div class="comments-section">
            <div class="section-header">
                <h2 class="section-title">Обсуждение</h2>
                <span class="section-count">{{ $book->comments->whereNull('parent_id')->count() }}</span>
            </div>
            <!-- Отправить комментарий если авторизирован -->
            @auth
                <div class="comment-form">
                    <form wire:submit="storeComment">
                        <textarea wire:model="commentBody" rows="3" placeholder="Напишите комментарий..."></textarea>
                        @error('commentBody') <span class="form-error">{{ $message }}</span> @enderror
                        <button type="submit" class="btn-submit">Отправить</button>
                    </form>
                </div>
            @endauth
            <!-- Отображение комментарий -->
            @forelse($book->comments->whereNull('parent_id') as $comment)
                <div class="comment-card">
                    <div class="comment-header">
                        <div class="comment-user">
                            <div class="avatar-xs">
                                @if($comment->user->avatar)
                                    <img src="{{ asset('storage/' . $comment->user->avatar) }}" alt="{{ $comment->user->name }}">
                                @else
                                    <span class="avatar-letter">{{ strtoupper(substr($comment->user->name, 0, 1)) }}</span>
                                @endif
                            </div>
                            <strong>{{ $comment->user->name }}</strong>
                            <time>{{ $comment->created_at->diffForHumans() }}</time>
                        </div>
                    </div>
                    <p class="comment-body">{{ $comment->body }}</p>
                    <!-- Отправить ответ к коментарию -->
                    @auth
                        <button class="btn-reply" 
                                wire:click="$toggle('replyOpen.{{ $comment->id }}')">
                            {{ ($replyOpen[$comment->id] ?? false) ? 'Отмена' : 'Ответить' }}
                        </button>
                        
                        @if($replyOpen[$comment->id] ?? false)
                            <div class="reply-form">
                                <form wire:submit="storeReply({{ $comment->id }})">
                                    <textarea 
                                        wire:model="replyBody" 
                                        rows="2" 
                                        placeholder="Ваш ответ..."></textarea>
                                    @error('replyBody') 
                                        <span class="form-error">{{ $message }}</span> 
                                    @enderror
                                    <button type="submit" class="btn-submit-sm">Отправить</button>
                                </form>
                            </div>
                        @endif
                    @endauth
                    <!-- Отобразить ответы к комментариям и кнопки -->
                    @if($comment->replies->count() > 0)
                        <div class="replies">

                            @php
                                $totalReplies = $comment->replies->count();
                                $isOpen = isset($showAllReplies[$comment->id]);   
                            @endphp

                            @if($isOpen)
                                @foreach($comment->replies as $reply)
                                    <div class="comment-card reply">
                                        <div class="comment-header">
                                            <div class="comment-user">
                                                <div class="avatar-xs">
                                                    @if($reply->user->avatar)
                                                        <img src="{{ asset('storage/' . $reply->user->avatar) }}" alt="{{ $reply->user->name }}">
                                                    @else
                                                        <span class="avatar-letter">{{ strtoupper(substr($reply->user->name, 0, 1)) }}</span>
                                                    @endif
                                                </div>
                                                <strong>{{ $reply->user->name }}</strong>
                                                <time>{{ $reply->created_at->diffForHumans() }}</time>
                                            </div>
                                        </div>
                                        <p class="comment-body">{{ $reply->body }}</p>
                                    </div>
                                @endforeach
                            @endif
                            <!-- Если ответов больше 5 - скрыть -->
                            @if($totalReplies > 5)
                                <button 
                                    class="btn-submit-sm"
                                    wire:click="toggleReplies({{ $comment->id }})">
                                    
                                    @if($isOpen)
                                        Скрыть ответы
                                    @else
                                        Показать все ответы ({{ $totalReplies }})
                                    @endif
                                </button>
                            @endif
                        </div>
                    @endif
                </div>
            <!-- Пока нет комментариев -->
            @empty
                <div class="empty-state">
                    <div class="empty-icon">💬</div>
                    <p>Пока нет комментариев. Начните обсуждение!</p>
                </div>
            @endforelse
        </div>
    </div>
</div>