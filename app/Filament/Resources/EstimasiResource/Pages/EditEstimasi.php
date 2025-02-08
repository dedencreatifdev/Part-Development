<?php

namespace App\Filament\Resources\EstimasiResource\Pages;

use App\Filament\Resources\EstimasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEstimasi extends EditRecord
{
    protected static string $resource = EstimasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
