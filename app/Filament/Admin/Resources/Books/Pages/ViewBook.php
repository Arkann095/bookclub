<?php

namespace App\Filament\Admin\Resources\Books\Pages;

use App\Filament\Admin\Resources\Books\BookResource;
use Filament\Resources\Pages\ViewRecord;

class ViewBook extends ViewRecord
{
    protected static string $resource = BookResource::class;
}