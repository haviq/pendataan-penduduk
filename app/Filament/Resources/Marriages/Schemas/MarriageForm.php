<?php

namespace App\Filament\Resources\Marriages\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class MarriageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('husband_resident_id')
                    ->label('Suami')
                    ->relationship(
                        name: 'husband',
                        titleAttribute: 'full_name',
                        modifyQueryUsing: fn (Builder $query) => $query->where('gender', 'Laki-laki'),
                    )
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('wife_resident_id')
                    ->label('Istri')
                    ->relationship(
                        name: 'wife',
                        titleAttribute: 'full_name',
                        modifyQueryUsing: fn (Builder $query) => $query->where('gender', 'Perempuan'),
                    )
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('marriage_certificate_number')
                    ->label('Nomor Akta Nikah')
                    ->default(null),

                DatePicker::make('marriage_date')
                    ->label('Tanggal Nikah'),

                TextInput::make('kua_name')
                    ->label('KUA')
                    ->default(null),

                TextInput::make('divorce_certificate_number')
                    ->label('Nomor Akta Cerai')
                    ->default(null),

                DatePicker::make('divorce_date')
                    ->label('Tanggal Cerai'),
            ]);
    }
}