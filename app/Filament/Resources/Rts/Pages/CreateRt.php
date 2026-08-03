<?php

namespace App\Filament\Resources\Rts\Pages;

use App\Filament\Resources\Rts\RtResource;
use Filament\Resources\Pages\CreateRecord;

class CreateRt extends CreateRecord
{
    protected static string $resource = RtResource::class;

    protected function getCreateFormAction(): \Filament\Actions\Action
{
    return parent::getCreateFormAction()->label('Simpan');
}

    protected function getCreateAnotherFormAction(): \Filament\Actions\Action
{
    return parent::getCreateAnotherFormAction()->label('Simpan & buat lainnya');
}

}
