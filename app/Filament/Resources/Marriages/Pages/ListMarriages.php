<?php

namespace App\Filament\Resources\Marriages\Pages;

use App\Filament\Resources\Marriages\MarriageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMarriages extends ListRecords
{
    protected static string $resource = MarriageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
