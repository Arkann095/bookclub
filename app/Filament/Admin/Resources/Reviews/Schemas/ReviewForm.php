<?php

namespace App\Filament\Admin\Resources\Reviews\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class ReviewForm
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
            TextInput::make('rating')
                ->label('Оценка')
                ->numeric()
                ->minValue(1)
                ->maxValue(5)
                ->required(),
            Textarea::make('body')
                ->label('Текст рецензии')
                ->required()
                ->maxLength(2000),
                DatePicker::make('started_at'),
                DatePicker::make('finished_at'),
            ]);
    }
}
