<?php

namespace App\Filament\Resources\Households\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class HouseholdForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('rt_id')
                    ->relationship('rt', 'number')
                    ->label('RT')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('no_kk')
                    ->label('Nomor KK')
                    ->required(),
                TextInput::make('pln_customer_number')
                    ->label('ID Pelanggan PLN')
                    ->default(null),
                Textarea::make('address')
                    ->label('Alamat')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}