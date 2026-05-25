
<x-layout>
    <x-slot name="title">Редактирование книги</x-slot>

    @if(session('success'))
        <div class="flash-message flash-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="flash-message flash-error">
            {{ session('error') }}
        </div>
    @endif

    <div class="create-book-container">
        <div class="back-link">
            <a href="{{ route('books.show', $book) }}" class="btn-back">← Назад к книге</a>
        </div>

        <div class="create-book-card">
            <div class="create-header">
                <h1 class="create-title">Редактирование книги</h1>
                <p class="create-subtitle">Измените информацию о книге</p>
            </div>

            <form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data" class="create-form">
                @csrf
                @method('PUT')

                <div class="form-layout">
                    {{-- Обложка --}}
                    <div class="form-left">
                        <div class="cover-upload">
                            <label class="cover-label" for="cover_image">
                                <div class="cover-preview">
                                    @if($book->cover_image)
                                        <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="cover-image" style="display:block;">
                                    @else
                                        <span class="cover-placeholder">📚</span>
                                        <span class="cover-text">Нажмите для загрузки обложки</span>
                                    @endif
                                </div>
                            </label>
                            <input type="file" name="cover_image" id="cover_image" accept="image/*" class="cover-input">
                            @error('cover_image')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Поля --}}
                    <div class="form-right">
                        <div class="form-group">
                            <label class="form-label" for="title">Название *</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $book->title) }}" class="form-input" required>
                            @error('title')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="author">Автор *</label>
                            <input type="text" name="author" id="author" value="{{ old('author', $book->author) }}" class="form-input" required>
                            @error('author')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label" for="published_year">Год издания</label>
                                <input type="number" name="published_year" id="published_year" value="{{ old('published_year', $book->published_year) }}" class="form-input" placeholder="2026" min="1900" max="2026">
                                @error('published_year')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="isbn">ISBN</label>
                                <input type="text" name="isbn" id="isbn" value="{{ old('isbn', $book->isbn) }}" class="form-input" placeholder="978-...">
                                @error('isbn')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="description">Описание</label>
                            <textarea name="description" id="description" rows="5" class="form-input" placeholder="Расскажите о книге...">{{ old('description', $book->description) }}</textarea>
                            @error('description')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="book_file">Файл книги</label>
                            <input type="file" name="book_file" id="book_file" accept=".pdf,.epub,.mobi,.fb2,.txt,.rtf,.doc,.docx" class="form-input">
                            @if($book->book_file)
                                <span class="current-file">Текущий файл: {{ basename($book->book_file) }}</span>
                            @endif
                            @error('book_file')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">Сохранить изменения</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>