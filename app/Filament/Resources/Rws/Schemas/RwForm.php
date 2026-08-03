<?php

namespace App\Filament\Resources\Rws\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RwForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('number')
                    ->label('Nomor RW')
                    ->required(),
                Select::make('chairman_resident_id')
                    ->relationship('chairman', 'full_name')
                    ->label('Ketua RW')
                    ->searchable()
                    ->preload()
                    ->default(null),
            ]);
    }
}