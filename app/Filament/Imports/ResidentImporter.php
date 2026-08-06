<?php

namespace App\Filament\Imports;

use App\Models\Resident;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class ResidentImporter extends Importer
{
    protected static ?string $model = Resident::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('household')
                ->label('No. KK')
                ->requiredMapping()
                ->relationship(resolveUsing: ['no_kk'])
                ->rules(['required']),

            ImportColumn::make('nik')
                ->requiredMapping()
                ->rules(['required', 'digits:16']),

            ImportColumn::make('full_name')
                ->requiredMapping()
                ->rules(['required', 'max:150']),

            ImportColumn::make('birth_place')
                ->rules(['max:100']),

            ImportColumn::make('birth_date')
                ->requiredMapping()
                ->rules(['required', 'date']),

            ImportColumn::make('gender')
                ->requiredMapping()
                ->rules(['required', 'in:Laki-laki,Perempuan']),

            ImportColumn::make('blood_type')
                ->rules(['nullable', 'in:A,B,AB,O,Tidak Tahu']),

            ImportColumn::make('religion')
                ->rules(['nullable', 'in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu']),

            ImportColumn::make('education')
                ->rules(['nullable', 'in:Tidak/Belum Sekolah,SD,SMP,SMA,D3,S1,S2,S3']),

            ImportColumn::make('occupation')
                ->rules(['max:100']),

            ImportColumn::make('marital_status')
                ->requiredMapping()
                ->rules(['required', 'in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati']),

            ImportColumn::make('relationship_to_head')
                ->requiredMapping()
                ->rules(['required', 'in:Kepala Keluarga,Suami,Istri,Anak,Menantu,Cucu,Orang Tua,Famili Lain,Lainnya']),

            ImportColumn::make('father_name')
                ->rules(['max:150']),

            ImportColumn::make('mother_name')
                ->rules(['max:150']),

            ImportColumn::make('birth_cert_number')
                ->rules(['max:50']),

            ImportColumn::make('birth_cert_issuer')
                ->rules(['max:100']),

            ImportColumn::make('has_ktp')
                ->boolean()
                ->rules(['boolean']),

            ImportColumn::make('status')
                ->requiredMapping()
                ->rules(['required', 'in:Aktif,Pindah,Meninggal']),

            ImportColumn::make('status_date')
                ->rules(['nullable', 'date']),

            ImportColumn::make('status_note'),
        ];
    }

    public function resolveRecord(): Resident
    {
        return Resident::firstOrNew([
            'nik' => $this->data['nik'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Import data warga selesai, ' . Number::format($import->successful_rows) . ' baris berhasil diimpor.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' baris gagal diimpor.';
        }

        return $body;
    }
}