<?php

namespace App\Filament\Resources\ActivityLogs;

use App\Filament\Resources\ActivityLogs\Pages\ListActivityLogs;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Tables;
use Spatie\Activitylog\Models\Activity;

class ActivityLogResource extends Resource
{
    protected static ?string $model = Activity::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;
    protected static ?string $modelLabel = 'Aktivitas';
    protected static ?string $pluralModelLabel = 'Log Aktivitas';
    protected static ?string $navigationLabel = 'Log Aktivitas';
    protected static string|\UnitEnum|null $navigationGroup = 'Sistem';
    protected static ?int $navigationSort = 1;
    protected static ?string $slug = 'activity-logs';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('#')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('description')
                    ->label('Aktivitas')
                    ->searchable()
                    ->wrap()
                    ->limit(80),
                Tables\Columns\TextColumn::make('causer.name')
                    ->label('Oleh')
                    ->default('-')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subject_type')
                    ->label('Tipe Data')
                    ->formatStateUsing(fn ($state) => $state ? class_basename($state) : '-')
                    ->badge()
                    ->color('info'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('log_name')
                    ->label('Jenis Log')
                    ->options([
                        'default' => 'Default (Model)',
                        'auth'    => 'Autentikasi',
                    ])
                    ->default(null),
                Tables\Filters\SelectFilter::make('subject_type')
                    ->label('Tipe Data')
                    ->options([
                        \App\Models\Resident::class        => 'Resident',
                        \App\Models\Household::class       => 'Household',
                        \App\Models\Rt::class              => 'Rt',
                        \App\Models\Rw::class              => 'Rw',
                        \App\Models\Marriage::class        => 'Marriage',
                        \App\Models\Surat::class           => 'Surat',
                        \App\Models\ResidentHistory::class => 'ResidentHistory',
                        \App\Models\User::class            => 'User',
                    ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->poll('30s');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListActivityLogs::route('/'),
        ];
    }
}
