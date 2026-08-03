<?php

namespace App\Filament\Resources\Residents\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ResidentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nik')
                    ->label('NIK')
                    ->searchable(),
                TextColumn::make('full_name')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('household.no_kk')
                    ->label('No. KK')
                    ->searchable(),
                TextColumn::make('gender')
                    ->label('Jenis Kelamin')
                    ->searchable(),
                TextColumn::make('birth_place')
                    ->label('Tempat Lahir')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('birth_date')
                    ->label('Tanggal Lahir')
                    ->date('d M Y')
                    ->sortable(),
                TextColumn::make('blood_type')
                    ->label('Golongan Darah')
                    ->toggleable(),
                TextColumn::make('religion')
                    ->label('Agama')
                    ->toggleable(),
                TextColumn::make('education')
                    ->label('Pendidikan')
                    ->toggleable(),
                TextColumn::make('occupation')
                    ->label('Pekerjaan')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('marital_status')
                    ->label('Status Kawin')
                    ->searchable(),
                TextColumn::make('relationship_to_head')
                    ->label('Status Keluarga')
                    ->searchable(),
                TextColumn::make('father_name')
                    ->label('Nama Ayah')
                    ->toggleable(),
                TextColumn::make('mother_name')
                    ->label('Nama Ibu')
                    ->toggleable(),
                TextColumn::make('birth_cert_number')
                    ->label('No. Akta Lahir')
                    ->toggleable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Aktif' => 'success',
                        'Pindah' => 'warning',
                        'Meninggal' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('status_date')
                    ->label('Tanggal Pindah/Meninggal')
                    ->date('d M Y')
                    ->toggleable(),
                TextColumn::make('status_note')
                    ->label('Keterangan')
                    ->limit(20)
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