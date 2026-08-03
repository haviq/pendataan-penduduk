<?php

namespace App\Filament\Resources\Rts\Pages;

use App\Filament\Resources\Rts\RtResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRt extends EditRecord
{
    protected static string $resource = RtResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
