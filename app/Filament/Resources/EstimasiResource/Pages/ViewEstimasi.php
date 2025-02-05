<?php

namespace App\Filament\Resources\EstimasiResource\Pages;

use App\Filament\Resources\EstimasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewEstimasi extends ViewRecord
{
    protected static string $resource = EstimasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
