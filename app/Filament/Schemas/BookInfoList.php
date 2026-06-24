<?php

namespace App\Filament\Schemas;

use Filament\Schemas\Schema;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;

class BookInfoList
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Основная информация')
                    ->schema([
                        TextEntry::make('title')->label('Название'),
                        TextEntry::make('author')->label('Автор'),
                        TextEntry::make('description')
                            ->label('Описание')
                            ->columnSpanFull(),
                        TextEntry::make('user.name')->label('Владелец'),
                        TextEntry::make('published_year')->label('Год издания'),
                        TextEntry::make('isbn')->label('ISBN'),
                        ImageEntry::make('cover_image')->label('Обложка'),
                        TextEntry::make('created_at')
                            ->label('Дата добавления')
                            ->dateTime(),
                        TextEntry::make('updated_at')
                            ->label('Обновлено')
                            ->dateTime(),
                    ]),
            ]);
    }
}
