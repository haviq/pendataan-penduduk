<?php

namespace App\Filament\Resources\Rws\Pages;

use App\Filament\Resources\Rws\RwResource;
use Filament\Resources\Pages\CreateRecord;

class CreateRw extends CreateRecord
{
    protected static string $resource = RwResource::class;

    protected function getCreateFormAction(): \Filament\Actions\Action
{
    return parent::getCreateFormAction()->label('Simpan');
}

    protected function getCreateAnotherFormAction(): \Filament\Actions\Action
{
    return parent::getCreateAnotherFormAction()->label('Simpan & buat lainnya');
}
}
