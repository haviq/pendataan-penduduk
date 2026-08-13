<?php

namespace App\Filament\Resources\Surat;

use App\Models\Surat;
use App\Models\Resident;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Forms;

class SuratResource extends Resource
{
    protected static ?string $model = Surat::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;
    protected static ?string $modelLabel = 'Surat';
    protected static ?string $pluralModelLabel = 'Surat';
    protected static ?string $navigationLabel = 'Surat Keterangan';
    protected static string|\UnitEnum|null $navigationGroup = 'Layanan';
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\Select::make('resident_id')
                ->label('Warga')
                ->relationship('resident', 'full_name')
                ->searchable()
                ->preload()
                ->required(),
            Forms\Components\Select::make('jenis_surat')
                ->label('Jenis Surat')
                ->options([
                    'domisili'      => 'Surat Keterangan Domisili',
                    'sktm'          => 'Surat Keterangan Tidak Mampu (SKTM)',
                    'pengantar_ktp' => 'Surat Pengantar KTP',
                ])
                ->required(),
            Forms\Components\TextInput::make('nomor_surat')
                ->label('Nomor Surat')
                ->placeholder('Contoh: 001/SK/VIII/2026')
                ->maxLength(100),
            Forms\Components\Textarea::make('keperluan')
                ->label('Keperluan')
                ->placeholder('Untuk keperluan...')
                ->columnSpanFull(),
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
                Tables\Columns\BadgeColumn::make('jenis_surat')
                    ->label('Jenis Surat')
                    ->formatStateUsing(fn ($state) => match($state) {
                        'domisili'      => 'Domisili',
                        'sktm'          => 'SKTM',
                        'pengantar_ktp' => 'Pengantar KTP',
                        default         => $state,
                    })
                    ->color(fn ($state) => match($state) {
                        'domisili'      => 'info',
                        'sktm'          => 'warning',
                        'pengantar_ktp' => 'success',
                        default         => 'gray',
                    }),
                Tables\Columns\TextColumn::make('nomor_surat')
                    ->label('No. Surat')
                    ->placeholder('-'),
                Tables\Columns\TextColumn::make('dicetak_oleh')
                    ->label('Dicetak Oleh'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                // Cetak via form POST terpisah (bukan GET) agar CSRF token
                // tidak bocor di URL/log. Form di-submit via JS hidden form.
                Tables\Actions\Action::make('cetak')
                    ->label('Cetak PDF')
                    ->icon(Heroicon::OutlinedArrowDownTray)
                    ->color('success')
                    ->action(function (Surat $record) {
                        // Redirect ke halaman surat index dengan data pre-filled
                        return redirect()->route('surat.index', [
                            'prefill_resident' => $record->resident_id,
                            'prefill_jenis'    => $record->jenis_surat,
                            'prefill_nomor'    => $record->nomor_surat,
                            'prefill_keperluan'=> $record->keperluan,
                        ]);
                    }),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListSurats::route('/'),
            'create' => Pages\CreateSurat::route('/create'),
        ];
    }
}
