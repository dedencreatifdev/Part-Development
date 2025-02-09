<?php

namespace App\Filament\Resources\EstimasiKendaraanResource\Pages;

use App\Filament\Resources\EstimasiKendaraanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEstimasiKendaraan extends EditRecord
{
    protected static string $resource = EstimasiKendaraanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
