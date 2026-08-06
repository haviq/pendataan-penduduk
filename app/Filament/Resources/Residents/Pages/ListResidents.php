<?php

namespace App\Filament\Resources\Residents\Pages;

use App\Filament\Resources\Residents\ResidentResource;
use App\Filament\Imports\ResidentImporter;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;
use Filament\Actions\ImportAction;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListResidents extends ListRecords
{
    protected static string $resource = ResidentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ImportAction::make()
                ->importer(ResidentImporter::class)
                ->label('Import CSV'),
            CreateAction::make(),

            Action::make('export_pdf')
                ->label('Export PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->color('gray')
                ->action(function () {
                    $residents = $this->getFilteredTableQuery()->get();

                    $pdf = Pdf::loadView('reports.residents', [
                        'residents' => $residents,
                    ])->setPaper('a4', 'landscape');

                    return response()->streamDownload(
                        fn () => print($pdf->output()),
                        'laporan-warga-' . now()->format('Ymd-His') . '.pdf'
                    );
                }),
        ];
    }
}