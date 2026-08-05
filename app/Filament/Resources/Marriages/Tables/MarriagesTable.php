<?php

namespace App\Filament\Resources\Marriages\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MarriagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('husband.full_name')
                    ->label('Suami')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('wife.full_name')
                    ->label('Istri')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('marriage_certificate_number')
                    ->label('No. Akta Nikah')
                    ->searchable(),
                TextColumn::make('marriage_date')
                    ->label('Tanggal Nikah')
                    ->date('d M Y')
                    ->sortable(),
                TextColumn::make('kua_name')
                    ->label('KUA')
                    ->searchable(),
                TextColumn::make('divorce_certificate_number')
                    ->label('No. Akta Cerai')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('divorce_date')
                    ->label('Tanggal Cerai')
                    ->date('d M Y')
                    ->sortable()
                    ->toggleable(),
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