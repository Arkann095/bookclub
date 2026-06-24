<?php

namespace App\Filament\Admin\Resources\Books;

use App\Filament\Admin\Resources\Books\Pages\CreateBook;
use App\Filament\Admin\Resources\Books\Pages\EditBook;
use App\Filament\Admin\Resources\Books\Pages\ListBooks;
use App\Filament\Admin\Resources\Books\Schemas\BookForm;
use App\Filament\Admin\Resources\Books\Tables\BooksTable;
use App\Models\Book;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use App\Filament\Admin\Resources\Books\RelationManagers\ReviewsRelationManager;
use App\Filament\Admin\Resources\Books\RelationManagers\CommentsRelationManager;
use App\Filament\Admin\Resources\Books\Pages\ViewBook;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookOpen;

    protected static ?string $navigationLabel = 'Книги';

    protected static ?string $recordTitleAttribute = 'title';
    protected static ?int $navigationSort = 2;  

    public static function form(Schema $schema): Schema
    {
        return BookForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BooksTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ReviewsRelationManager::class,
            CommentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBooks::route('/'),
            'create' => CreateBook::route('/create'),
            'edit' => EditBook::route('/{record}/edit'),
            'view' => ViewBook::route('/{record}'),
        ];
    }
}
