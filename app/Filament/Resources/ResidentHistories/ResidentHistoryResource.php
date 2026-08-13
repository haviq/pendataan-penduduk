<?php

namespace App\Filament\Resources\ResidentHistories;

use App\Filament\Resources\ResidentHistories\Pages\CreateResidentHistory;
use App\Filament\Resources\ResidentHistories\Pages\EditResidentHistory;
use App\Filament\Resources\ResidentHistories\Pages\ListResidentHistories;
use App\Models\ResidentHistory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Forms;

class ResidentHistoryResource extends Resource
{
    protected static ?string $model = ResidentHistory::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowPath;
    protected static ?string $modelLabel = 'Riwayat Perpindahan';
    protected static ?string $pluralModelLabel = 'Riwayat Perpindahan';
    protected static ?string $navigationLabel = 'Riwayat Perpindahan';
    protected static string|\UnitEnum|null $navigationGroup = 'Data Kependudukan';
    protected static ?int $navigationSort = 10;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\Select::make('resident_id')
                ->label('Warga')
                ->relationship('resident', 'full_name')
                ->searchable()
                ->preload()
                ->required(),
            Forms\Components\Select::make('jenis_perubahan')
                ->label('Jenis Perubahan')
                ->options([
                    'pindah_masuk'   => 'Pindah Masuk',
                    'pindah_keluar'  => 'Pindah Keluar',
                    'meninggal'      => 'Meninggal',
                    'aktif_kembali'  => 'Aktif Kembali',
                    'perubahan_data' => 'Perubahan Data',
                ])
                ->required(),
            Forms\Components\DatePicker::make('tanggal_perubahan')
                ->label('Tanggal Perubahan')
                ->default(now())
                ->required(),
            Forms\Components\TextInput::make('asal_alamat')
                ->label('Asal Alamat')
                ->maxLength(200),
            Forms\Components\TextInput::make('tujuan_alamat')
                ->label('Tujuan Alamat')
                ->maxLength(200),
            Forms\Components\Textarea::make('keterangan')
                ->label('Keterangan')
                ->columnSpanFull(),
            Forms\Components\TextInput::make('dicatat_oleh')
                ->label('Dicatat Oleh')
                ->maxLength(100),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('resident.full_name')
                    ->label('Nama Warga')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('jenis_perubahan')
                    ->label('Jenis')
                    ->formatStateUsing(fn ($state) => match($state) {
                        'pindah_masuk'   => 'Pindah Masuk',
                        'pindah_keluar'  => 'Pindah Keluar',
                        'meninggal'      => 'Meninggal',
                        'aktif_kembali'  => 'Aktif Kembali',
                        'perubahan_data' => 'Perubahan Data',
                        default          => $state,
                    })
                    ->color(fn ($state) => match($state) {
                        'pindah_masuk'   => 'success',
                        'pindah_keluar'  => 'warning',
                        'meninggal'      => 'danger',
                        'aktif_kembali'  => 'info',
                        'perubahan_data' => 'gray',
                        default          => 'gray',
                    }),
                Tables\Columns\TextColumn::make('tanggal_perubahan')
                    ->label('Tanggal')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('asal_alamat')
                    ->label('Asal')
                    ->limit(30)
                    ->toggleable(),
                Tables\Columns\TextColumn::make('tujuan_alamat')
                    ->label('Tujuan')
                    ->limit(30)
                    ->toggleable(),
                Tables\Columns\TextColumn::make('keterangan')
                    ->label('Keterangan')
                    ->limit(40)
                    ->toggleable(),
                Tables\Columns\TextColumn::make('dicatat_oleh')
                    ->label('Dicatat Oleh')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('jenis_perubahan')
                    ->label('Jenis Perubahan')
                    ->options([
                        'pindah_masuk'   => 'Pindah Masuk',
                        'pindah_keluar'  => 'Pindah Keluar',
                        'meninggal'      => 'Meninggal',
                        'aktif_kembali'  => 'Aktif Kembali',
                        'perubahan_data' => 'Perubahan Data',
                    ]),
            ])
            ->defaultSort('tanggal_perubahan', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListResidentHistories::route('/'),
            'create' => CreateResidentHistory::route('/create'),
            'edit'   => EditResidentHistory::route('/{record}/edit'),
        ];
    }
}
