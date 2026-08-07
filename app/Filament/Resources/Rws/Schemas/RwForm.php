<?php

namespace App\Filament\Resources\Rws\Schemas;

use App\Models\Rw;
use Illuminate\Database\Eloquent\Builder;
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
                    ->relationship(
                        name: 'chairman',
                        titleAttribute: 'full_name',
                        modifyQueryUsing: fn (Builder $query, ?Rw $record) =>$record
                            ? $query->whereHas('household.rt', fn (Builder $q) => $q->where('rw_id', $record->id))
                                ->where('status', 'Aktif')
                                ->whereDate('birth_date', '<=', now()->subYears(17)->format('Y-m-d'))
                            : $query->whereRaw('1=0'),
                    )
                    ->label('Ketua RW')
                    ->searchable()
                    ->preload()
                    ->default(null),
            ]);
    }
}