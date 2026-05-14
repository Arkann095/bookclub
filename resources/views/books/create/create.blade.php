
<x-layout>
    <x-slot name="title">Добавить книгу</x-slot>

    <link rel="stylesheet" href="{{ asset('css/books/create.css') }}">

    <div class="create-book-container">
        <div class="back-link">
            <a href="{{ url()->previous() }}" class="btn-back">← Назад</a>
        </div>

        <div class="create-book-card">
            <div class="create-header">
                <h1 class="create-title">Новая книга</h1>
                <p class="create-subtitle">Заполните информацию о книге, чтобы добавить её в каталог</p>
            </div>

            <form action="{{ route('book.create') }}" method="POST" enctype="multipart/form-data" class="create-form">
                @csrf

                <div class="form-layout">
                    <div class="form-left">
                        <div class="cover-upload">
                            <label class="cover-label" for="cover_image">
                                <div class="cover-preview">
                                    <span class="cover-placeholder">📚</span>
                                    <span class="cover-text">Нажмите для загрузки обложки</span>
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
                            <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-input" placeholder="Введите название книги" required>
                            @error('title')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="author">Автор *</label>
                            <input type="text" name="author" id="author" value="{{ old('author') }}" class="form-input" placeholder="Имя и фамилия автора" required>
                            @error('author')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label" for="published_year">Год издания</label>
                                <input type="number" name="published_year" id="published_year" value="{{ old('published_year') }}" class="form-input" placeholder="2026" min="1900" max="2026">
                                @error('published_year')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="isbn">ISBN</label>
                                <input type="text" name="isbn" id="isbn" value="{{ old('isbn') }}" class="form-input" placeholder="978-...">
                                @error('isbn')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="description">Описание</label>
                            <textarea name="description" id="description" rows="5" class="form-input" placeholder="Расскажите о книге, сюжете, интересных фактах...">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">Добавить книгу</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>