<div>
    <section class="books-section">
        <div class="container">
            <h1 class="books-title">Каталог книг</h1>

            <div class="search-box">
                <input 
                    type="text" 
                    wire:model.live="search" 
                    placeholder="Поиск по названию или автору..."
                    class="search-input"
                >
            </div>
            
            <div class="books-grid">
                @forelse($books as $book)
                    <a href="{{ route('books.show', $book) }}" class="book-card">
                        <div class="book-cover">
                            @if($book->cover_image)
                                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}">
                            @else
                                <div class="book-cover-placeholder">
                                    <span>{{ strtoupper(substr($book->title, 0, 1)) }}</span>
                                </div>
                            @endif
                        </div>

                        <div class="book-info">
                            <h3 class="book-title">{{ $book->title }}</h3>
                            <p class="book-author">{{ $book->author }}</p>

                            @if($book->reviews_avg_rating)
                                <div class="book-rating">
                                    ★ {{ number_format($book->reviews_avg_rating, 1) }}
                                </div>
                            @else
                                <p>Нет оценок</p>
                            @endif
                        </div>
                    </a>
                @empty
                    <p>Нет книг</p>
                @endforelse
            </div>

            {{ $books->links() }}

        </div>
    </section>
</div>