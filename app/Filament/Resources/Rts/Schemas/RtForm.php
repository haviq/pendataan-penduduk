<?php

namespace App\Filament\Resources\Rts\Schemas;

use App\Models\Rt;
use Illuminate\Database\Eloquent\Builder;
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
                    ->relationship(
                        name: 'chairman',
                        titleAttribute: 'full_name',
                        modifyQueryUsing: fn (Builder $query, ? Rt $record) => $record
                            ? $query->whereHas('household', fn (Builder $q) => $q->where('rt_id', $record->id))
                                ->where('status', 'Aktif')
                                ->whereDate('birth_date', '<=', now()->subYears(17)->format('Y-m-d'))
                            : $query->whereRaw('1=0'),
                    )
                    ->label('Ketua RT')
                    ->searchable()
                    ->preload()
                    ->default(null),
            ]);
    }
}