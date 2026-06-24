<?php

namespace App\Filament\Admin\Resources\Books\RelationManagers;


use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;

class ReviewsRelationManager extends RelationManager
{
    protected static string $relationship = 'reviews';

    // protected static ?string $relatedResource = BookResource::class;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Автор')
                    ->relationship('user', 'name')
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
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('Автор'),
                TextColumn::make('rating')->label('Оценка'),
                TextColumn::make('body')->label('Текст')->limit(50),
                TextColumn::make('created_at')->label('Дата')->dateTime(),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);  
    }
}
