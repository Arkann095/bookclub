<?php

namespace App\Filament\Admin\Resources\Books\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\ColorPicker;
use Filament\Schemas\Schema;

class BookForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Владелец книги')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->nullable(),
                TextInput::make('title')
                    ->label('Название книги')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Введите название книги'),
                TextInput::make('author')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->nullable()
                    ->maxLength(5000)
                    ->columnSpanFull(),
                FileUpload::make('cover_image')
                    ->image()
                    ->directory('books/covers')
                    ->maxSize(2048),
                FileUpload::make('book_file')
                    ->directory('books/files')
                    ->maxSize(10240),
                TextInput::make('published_year')
                    ->numeric()
                    ->minValue(1900)
                    ->maxValue((int) date('Y')),
                TextInput::make('isbn')
                    ->unique(ignoreRecord: true)
                    ->maxLength(20),
            ]);
    }
}
