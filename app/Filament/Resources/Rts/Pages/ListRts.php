<?php

namespace App\Filament\Resources\Rts\Pages;

use App\Filament\Resources\Rts\RtResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRts extends ListRecords
{
    protected static string $resource = RtResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
