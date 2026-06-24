<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Всего книг', \App\Models\Book::count())
                ->icon('heroicon-o-book-open'),
            Stat::make('С обложкой', \App\Models\Book::whereNotNull('cover_image')->count()),
            Stat::make('С файлом', \App\Models\Book::whereNotNull('book_file')->count()),
        ];
    }

    protected function getHeading(): string
    {
        return 'Статистика по книгам';
    }

    protected int | string | array $columnSpan = 3;
}
