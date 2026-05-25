<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
       return [
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'cover_image' => ['nullable', 'image', 'max:2048'],
            'published_year' => ['nullable', 'integer', 'min:1900', 'max:' . date('Y')],
            'isbn' => ['nullable', 'string', 'max:20'],
            'book_file' => ['nullable', 'file', 'mimes:pdf,epub,mobi,fb2,txt,rtf,doc,docx', 'max:10240'],
        ];
    }

    public function messages() {
        return [
            'title.required' => 'Название книги обязательно',
            'title.max' => 'Название не должно быть длиннее 255 символов',
            'author.required' => 'Автор обязателен',
            'author.max' => 'Имя автора не должно быть длиннее 255 символов',
            'cover_image.image' => 'Файл должен быть изображением',
            'cover_image.max' => 'Размер обложки не должен превышать 2 МБ',
            'published_year.integer' => 'Год должен быть числом',
            'published_year.min' => 'Год не может быть раньше 1900',
            'published_year.max' => 'Год не может быть больше текущего',
            'book_file.mimes' => 'Поддерживаются форматы: PDF, EPUB, MOBI, FB2, TXT, RTF, DOC, DOCX',
            'book_file.max' => 'Файл книги не должен превышать 10 МБ',
        ];
    }

    public function attributes() {

        return [
            'title' => 'Название книги',
            'author' => 'Автор',
            'description' => 'Описание',
            'cover_image' => 'Обложка',
            'published_year' => 'Дата публикации',
            'book_file' => 'Книга'
        ];

    }


}
