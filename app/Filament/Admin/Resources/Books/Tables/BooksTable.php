<?php

namespace App\Filament\Admin\Resources\Books\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\DeleteAction; 
use Filament\Actions\Action;        
use Filament\Notifications\Notification;  
use Filament\Actions\ViewAction;
class BooksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Владелец')
                    ->sortable(),
                TextColumn::make('title')
                    ->label('Заголовок')
                    ->searchable(),
                TextColumn::make('author')
                    ->label('Автор')
                    ->searchable(),
                ImageColumn::make('cover_image')
                    ->label('Обложка')
                    ->disk('public'),
                TextColumn::make('book_file')
                    ->label('Копия книги')
                    ->searchable(),
                TextColumn::make('published_year')
                    ->label('Год публикации'),
                TextColumn::make('isbn')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            // ->actions([
            //     Action::make('say_hello')
            //         ->label('Привет')
            //         ->action(function ($record) {
            //             Notification::make()
            //                 ->success()
            //                 ->title('Привет, мир!')
            //                 ->body('Ты нажал на книгу: ' . $record->title)
            //                 ->send();
            //         }),
            // ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
                ViewAction::make(),
                Action::make('say_hello')      // ← КАСТОМНАЯ КНОПКА
                ->label('Привет')
                ->action(function ($record) {
                    Notification::make()
                        ->success()
                        ->title('Привет, ' . $record->title)
                        ->send();
                }),
            ]);
            
            // ->recordActions([
            //     EditAction::make(),
            // ])
            // ->toolbarActions([
            //     BulkActionGroup::make([
            //         DeleteBulkAction::make(),
            //     ]),
            // ]);
    }
}
