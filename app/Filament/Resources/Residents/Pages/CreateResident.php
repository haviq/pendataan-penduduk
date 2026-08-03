<?php

namespace App\Filament\Resources\Residents\Pages;

use App\Filament\Resources\Residents\ResidentResource;
use Filament\Resources\Pages\CreateRecord;

class CreateResident extends CreateRecord
{
    protected static string $resource = ResidentResource::class;

    protected function getCreateFormAction(): \Filament\Actions\Action
{
    return parent::getCreateFormAction()->label('Simpan');
}

    protected function getCreateAnotherFormAction(): \Filament\Actions\Action
{
    return parent::getCreateAnotherFormAction()->label('Simpan & buat lainnya');
}
}
