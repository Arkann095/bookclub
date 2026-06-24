<?php

namespace App\Filament\Admin\Resources\Books\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CommentsRelationManager extends RelationManager
{
    protected static string $relationship = 'comments';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Автор')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required(),
                Textarea::make('body')
                    ->label('Текст комментария')
                    ->required()
                    ->maxLength(2000),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('Автор'),
                TextColumn::make('body')->label('Текст')->limit(50),
                TextColumn::make('created_at')->label('Дата')->dateTime(),
            ])
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}