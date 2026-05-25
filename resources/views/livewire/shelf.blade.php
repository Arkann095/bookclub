<div>
    <link rel="stylesheet" href="{{ asset('css/profile/shelf.css') }}">

    <section class="shelf-hero">
        <div class="container">
            <h1 class="shelf-title">Моя полка</h1>
            <p class="shelf-subtitle">Книги, которые вы читаете, прочитали или хотите прочитать</p>
        </div>
    </section>

    <div class="container shelf-content">
        <div class="shelf-tabs">
            <button class="tab {{ $tab === 'want_to_read' ? 'active' : '' }}" wire:click="$set('tab', 'want_to_read')">
                Хочу прочитать
            </button>
            <button class="tab {{ $tab === 'reading' ? 'active' : '' }}" wire:click="$set('tab', 'reading')">
                Читаю сейчас
            </button>
            <button class="tab {{ $tab === 'read' ? 'active' : '' }}" wire:click="$set('tab', 'read')">
                Прочитал
            </button>
        </div>

        @php
            $books = $user->shelves->where('status', $tab);
        @endphp

        <div class="shelf-grid">
            @forelse($books as $shelf)
                <a href="{{ route('books.show', $shelf->book) }}" class="shelf-book-card">
                    <div class="shelf-book-cover">
                        @if($shelf->book->cover_image)
                            <img src="{{ asset('storage/' . $shelf->book->cover_image) }}" alt="{{ $shelf->book->title }}">
                        @else
                            <span class="shelf-book-letter">{{ strtoupper(substr($shelf->book->title, 0, 1)) }}</span>
                        @endif
                        
                        {{-- Бейдж статуса --}}
                        <span class="shelf-badge {{ $tab }}">
                            @if($tab === 'want_to_read')
                                📌
                            @elseif($tab === 'reading')
                                📖
                            @else
                                ✓
                            @endif
                        </span>
                    </div>
                    <div class="shelf-book-info">
                        <h3 class="shelf-book-title">{{ $shelf->book->title }}</h3>
                        <p class="shelf-book-author">{{ $shelf->book->author }}</p>
                        
                        @if($shelf->started_at && $shelf->finished_at)
                            <span class="shelf-dates">
                                {{ $shelf->started_at->format('d.m.Y') }} — {{ $shelf->finished_at->format('d.m.Y') }}
                            </span>
                        @endif
                    </div>
                </a>
            @empty
                <div class="empty-state">
                    <div class="empty-icon">
                        @if($tab === 'want_to_read') 📌
                        @elseif($tab === 'reading') 📖
                        @else ✓
                        @endif
                    </div>
                    <p>
                        @if($tab === 'want_to_read')
                            Здесь появятся книги, которые вы хотите прочитать
                        @elseif($tab === 'reading')
                            Здесь появятся книги, которые вы читаете сейчас
                        @else
                            Здесь появятся прочитанные книги
                        @endif
                    </p>
                </div>
            @endforelse
        </div>
    </div>
</div>
