<?php

namespace App\Filament\Resources\Marriages\Pages;

use App\Filament\Resources\Marriages\MarriageResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMarriage extends CreateRecord
{
    protected static string $resource = MarriageResource::class;

    protected function getCreateFormAction(): \Filament\Actions\Action
    {
        return parent::getCreateFormAction()->label('Simpan');
    }

    protected function getCreateAnotherFormAction(): \Filament\Actions\Action
    {
        return parent::getCreateAnotherFormAction()->label('Simpan & buat lainnya');
    }
}
