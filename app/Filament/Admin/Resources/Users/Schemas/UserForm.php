<?php

namespace App\Filament\Admin\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('password')
                    ->password(),
                FileUpload::make('avatar')
                    ->image()
                    ->directory('avatars')
                    ->maxSize(2048),
                Textarea::make('bio')
                    ->columnSpanFull()
                    ->maxLength(500),
                Toggle::make('is_admin')
                    ->required(),
                Toggle::make('is_private')
                    ->required(),
                DateTimePicker::make('email_verified_at')
                ->nullable(),
            ]);
    }
}
