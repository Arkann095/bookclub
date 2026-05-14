<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Http\Requests\StoreBookRequest;

class BookController extends Controller
{
    
    public function store(StoreBookRequest $request) {

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('books', 'public');
        }

            Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'published_year' => $request->published_year,
            'isbn' => $request->isbn,
            'cover_image' => $path ?? null,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('books.index')->with('success', 'Книга добавлена');

    }

}
