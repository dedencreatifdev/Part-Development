<?php

namespace App\Filament\Resources\EstimasiKendaraanResource\Pages;

use App\Filament\Resources\EstimasiKendaraanResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewEstimasiKendaraan extends ViewRecord
{
    protected static string $resource = EstimasiKendaraanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
