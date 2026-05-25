<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Shelf;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;

use Illuminate\Support\Facades\Storage;


class BookController extends Controller
{
    
    public function store(StoreBookRequest $request) {

        if ($request->hasFile('cover_image')) {
            $pathCover = $request->file('cover_image')->store('books/covers', 'public');
        }

        if ($request->hasFile('book_file')) {
            $pathFile = $request->file('book_file')->store('books/files', 'public');
        }

            Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'published_year' => $request->published_year,
            'isbn' => $request->isbn,
            'cover_image' => $pathCover ?? null,
            'book_file' => $pathFile ?? null,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('books.index')->with('success', 'Книга добавлена');

    }
    public function downloadBook(Book $book) {
    
        if (!$book->book_file) {
            abort(404);
        }
        
        return Storage::disk('public')->download($book->book_file);

    }

    public function addBook(Book $book) {

        $exists = Shelf::where('user_id', auth()->id())
            ->where('book_id', $book->id)
            ->exists();

        if (!$exists) {
            Shelf::create([
                'user_id' => auth()->id(),
                'book_id' => $book->id,
                'status' => 'want_to_read',
            ]);
        }

        return back()->with('success', 'Книга добавлена на полку');

    }

    public function edit(Book $book) {
    
        return view('books.edit.edit', compact('book'));

    }

    public function update(UpdateBookRequest $request, Book $book) {

        $validated = $request->validated();
    
        if ($request->hasFile('book_file')) {
            if ($book->book_file) {
                Storage::disk('public')->delete($book->book_file);
            }

            $pathFile = $request->file('book_file')->store('books/files', 'public');
            $validated['book_file'] = $pathFile;
        }

        if ($request->hasFile('cover_image')) {

            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }

            $pathImage = $request->file('cover_image')->store('books/covers', 'public');
            $validated['cover_image'] = $pathImage;
        }

        $book->update([
            'title' => $validated['title'] ?? $book->title,
            'author' => $validated['author'] ?? $book->author,
            'description' => $validated['description'] ?? $book->description,
            'cover_image' => $validated['cover_image'] ?? $book->cover_image,
            'book_file' => $validated['book_file'] ?? $book->book_file,
            'published_year' => $validated['published_year'] ?? $book->published_year,
            'isbn' => $validated['isbn'] ?? $book->isbn,
        ]);

        return back()->with('success', 'книга обновлена');

    }

}
