<?php

namespace App\Filament\Imports;

use App\Models\Household;
use App\Models\Rt;
use Filament\Actions\Imports\Exceptions\RowImportFailedException;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class HouseholdImporter extends Importer
{
    protected static ?string $model = Household::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('rw_number')
                ->label('Nomor RW')
                ->requiredMapping()
                ->rules(['required'])
                ->fillRecordUsing(fn () => null),

            ImportColumn::make('rt_number')
                ->label('Nomor RT')
                ->requiredMapping()
                ->rules(['required'])
                ->fillRecordUsing(fn () => null),

            ImportColumn::make('no_kk')
                ->label('Nomor KK')
                ->requiredMapping()
                ->rules(['required', 'max:20']),

            ImportColumn::make('address')
                ->label('Alamat')
                ->requiredMapping()
                ->rules(['required']),

            ImportColumn::make('pln_customer_number')
                ->label('ID Pelanggan PLN')
                ->rules(['max:20']),
        ];
    }

    public function resolveRecord(): Household
    {
        $rt = Rt::whereHas('rw', fn ($q) => $q->where('number', $this->data['rw_number']))
            ->where('number', $this->data['rt_number'])
            ->first();

        if (! $rt) {
            throw new RowImportFailedException(
                "Kombinasi RW {$this->data['rw_number']} / RT {$this->data['rt_number']} tidak ditemukan."
            );
        }

        $household = Household::firstOrNew([
            'no_kk' => $this->data['no_kk'],
        ]);

        $household->rt_id = $rt->id;

        return $household;
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Import data kartu keluarga selesai, ' . Number::format($import->successful_rows) . ' baris berhasil diimpor.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' baris gagal diimpor.';
        }

        return $body;
    }
}