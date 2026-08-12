<?php

namespace App\Filament\Resources\Households\Pages;

use App\Filament\Imports\HouseholdImporter;
use App\Filament\Resources\Households\HouseholdResource;
use Filament\Actions\CreateAction;
use Filament\Actions\ImportAction;
use Filament\Resources\Pages\ListRecords;

class ListHouseholds extends ListRecords
{
    protected static string $resource = HouseholdResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ImportAction::make()
                ->importer(HouseholdImporter::class)
                ->label('Import CSV'),

            CreateAction::make(),
        ];
    }
}
