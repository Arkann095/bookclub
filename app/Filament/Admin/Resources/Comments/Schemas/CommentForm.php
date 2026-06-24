<?php

namespace App\Filament\Admin\Resources\Comments\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class CommentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Пользователь')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required(),
                Select::make('book_id')
                    ->label('Книга')
                    ->relationship('book', 'title')
                    ->searchable()
                    ->required(),
                TextInput::make('parent_id')
                    ->numeric(),
                Textarea::make('body')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
