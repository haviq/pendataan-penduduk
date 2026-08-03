<?php

namespace App\Filament\Resources\Rws\Pages;

use App\Filament\Resources\Rws\RwResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRws extends ListRecords
{
    protected static string $resource = RwResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
