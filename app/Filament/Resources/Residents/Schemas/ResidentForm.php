<?php

namespace App\Filament\Resources\Residents\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ResidentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('household_id')
                    ->relationship('household', 'no_kk')
                    ->label('Kartu Keluarga (No. KK)')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Akun Login (opsional)')
                    ->searchable()
                    ->preload()
                    ->default(null),
                TextInput::make('nik')
                    ->label('NIK')
                    ->required(),
                TextInput::make('full_name')
                    ->label('Nama Lengkap')
                    ->required(),
                TextInput::make('birth_place')
                    ->label('Tempat Lahir')
                    ->default(null),
                DatePicker::make('birth_date')
                    ->label('Tanggal Lahir')
                    ->required(),
                Select::make('gender')
                    ->label('Jenis Kelamin')
                    ->options([
                        'Laki-laki' => 'Laki-laki',
                        'Perempuan' => 'Perempuan',
                    ])
                    ->required(),
                Select::make('blood_type')
                    ->label('Golongan Darah')
                    ->options([
                        'A' => 'A',
                        'B' => 'B',
                        'AB' => 'AB',
                        'O' => 'O',
                        'Tidak Tahu' => 'Tidak Tahu',
                    ])
                    ->default(null),
                Select::make('religion')
                    ->label('Agama')
                    ->options([
                        'Islam' => 'Islam',
                        'Kristen' => 'Kristen',
                        'Katolik' => 'Katolik',
                        'Hindu' => 'Hindu',
                        'Buddha' => 'Buddha',
                        'Konghucu' => 'Konghucu',
                    ])
                    ->default(null),
                Select::make('education')
                    ->label('Pendidikan Terakhir')
                    ->options([
                        'Tidak/Belum Sekolah' => 'Tidak/Belum Sekolah',
                        'SD' => 'SD',
                        'SMP' => 'SMP',
                        'SMA' => 'SMA',
                        'D3' => 'D3',
                        'S1' => 'S1',
                        'S2' => 'S2',
                        'S3' => 'S3',
                    ])
                    ->default(null),
                TextInput::make('occupation')
                    ->label('Pekerjaan')
                    ->default(null),
                Select::make('marital_status')
                    ->label('Status Perkawinan')
                    ->options([
                        'Belum Kawin' => 'Belum Kawin',
                        'Kawin' => 'Kawin',
                        'Cerai Hidup' => 'Cerai Hidup',
                        'Cerai Mati' => 'Cerai Mati',
                    ])
                    ->default('Belum Kawin')
                    ->required(),
                Select::make('relationship_to_head')
                    ->label('Status dalam Keluarga')
                    ->options([
                        'Kepala Keluarga' => 'Kepala Keluarga',
                        'Suami' => 'Suami',
                        'Istri' => 'Istri',
                        'Anak' => 'Anak',
                        'Menantu' => 'Menantu',
                        'Cucu' => 'Cucu',
                        'Orang Tua' => 'Orang Tua',
                        'Famili Lain' => 'Famili Lain',
                        'Lainnya' => 'Lainnya',
                    ])
                    ->required(),
                TextInput::make('father_name')
                    ->label('Nama Ayah')
                    ->default(null),
                TextInput::make('mother_name')
                    ->label('Nama Ibu')
                    ->default(null),
                TextInput::make('birth_cert_number')
                    ->label('Nomor Akta Lahir')
                    ->default(null),
                TextInput::make('birth_cert_issuer')
                    ->label('Kabupaten/Kota Penerbit Akta')
                    ->default(null),
                Toggle::make('has_ktp')
                    ->label('Sudah Punya KTP')
                    ->default(false),
                Select::make('status')
                    ->label('Status Kependudukan')
                    ->options([
                        'Aktif' => 'Aktif',
                        'Pindah' => 'Pindah',
                        'Meninggal' => 'Meninggal',
                    ])
                    ->default('Aktif')
                    ->required(),
                DatePicker::make('status_date')
                    ->label('Tanggal Pindah/Meninggal'),
                Textarea::make('status_note')
                    ->label('Keterangan')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}