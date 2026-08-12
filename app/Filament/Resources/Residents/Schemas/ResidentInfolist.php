<?php

namespace App\Filament\Resources\Residents\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ResidentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nik')
                    ->label('NIK'),
                TextEntry::make('full_name')
                    ->label('Nama Lengkap'),
                TextEntry::make('household.no_kk')
                    ->label('No. KK'),
                TextEntry::make('user.name')
                    ->label('Akun Login')
                    ->placeholder('-'),
                TextEntry::make('birth_place')
                    ->label('Tempat Lahir')
                    ->placeholder('-'),
                TextEntry::make('birth_date')
                    ->label('Tanggal Lahir')
                    ->date('d M Y'),
                TextEntry::make('age')
                    ->label('Usia')
                    ->formatStateUsing(fn ($state) => $state !== null ? $state . ' tahun' : '-'),
                TextEntry::make('gender')
                    ->label('Jenis Kelamin'),
                TextEntry::make('blood_type')
                    ->label('Golongan Darah')
                    ->placeholder('-'),
                TextEntry::make('religion')
                    ->label('Agama')
                    ->placeholder('-'),
                TextEntry::make('education')
                    ->label('Pendidikan')
                    ->placeholder('-'),
                TextEntry::make('occupation')
                    ->label('Pekerjaan')
                    ->placeholder('-'),
                TextEntry::make('marital_status')
                    ->label('Status Perkawinan'),
                TextEntry::make('relationship_to_head')
                    ->label('Status dalam Keluarga'),
                TextEntry::make('father_name')
                    ->label('Nama Ayah')
                    ->placeholder('-'),
                TextEntry::make('mother_name')
                    ->label('Nama Ibu')
                    ->placeholder('-'),
                TextEntry::make('birth_cert_number')
                    ->label('Nomor Akta Lahir')
                    ->placeholder('-'),
                TextEntry::make('birth_cert_issuer')
                    ->label('Kabupaten/Kota Penerbit Akta')
                    ->placeholder('-'),
                IconEntry::make('has_ktp')
                    ->label('Sudah Punya KTP')
                    ->boolean(),
                TextEntry::make('status')
                    ->label('Status Kependudukan')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Aktif' => 'success',
                        'Pindah' => 'warning',
                        'Meninggal' => 'danger',
                        default => 'gray',
                    }),
                TextEntry::make('status_date')
                    ->label('Tanggal Pindah/Meninggal')
                    ->date('d M Y')
                    ->placeholder('-'),
                TextEntry::make('status_note')
                    ->label('Keterangan')
                    ->placeholder('-')
                    ->columnSpanFull(),
            ]);
    }
}