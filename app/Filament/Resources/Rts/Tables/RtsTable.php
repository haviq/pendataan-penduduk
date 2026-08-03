<?php

namespace App\Filament\Resources\Rts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RtsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('rw.number')
                    ->label('RW')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('number')
                    ->label('Nomor RT')
                    ->searchable(),
                TextColumn::make('chairman.full_name')
                    ->label('Ketua RT')
                    ->searchable()
                    ->default('-'),
                TextColumn::make('households_count')
                    ->label('Jumlah KK')
                    ->counts('households')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}