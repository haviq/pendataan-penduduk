<?php

namespace App\Filament\Resources\Households\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class HouseholdsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no_kk')
                    ->label('Nomor KK')
                    ->searchable(),
                TextColumn::make('pln_customer_number')
                    ->label('ID PLN')
                    ->searchable()
                    ->placeholder('Belum Diisi')
                    ->toggleable(),
                TextColumn::make('rt.number')
                    ->label('RT')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('rt.rw.number')
                    ->label('RW')
                    ->searchable(),
                TextColumn::make('head.full_name')
                    ->label('Kepala Keluarga')
                    ->default('-'),
                TextColumn::make('address')
                    ->label('Alamat')
                    ->limit(30)
                    ->searchable(),
                TextColumn::make('residents_count')
                    ->label('Jumlah Anggota')
                    ->counts('residents')
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
            ->striped()
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