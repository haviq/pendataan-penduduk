<?php

namespace App\Filament\Resources\Rts\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RtForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('rw_id')
                    ->relationship('rw', 'number')
                    ->label('RW')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('number')
                    ->label('Nomor RT')
                    ->required(),
                Select::make('chairman_resident_id')
                    ->relationship('chairman', 'full_name')
                    ->label('Ketua RT')
                    ->searchable()
                    ->preload()
                    ->default(null),
            ]);
    }
}