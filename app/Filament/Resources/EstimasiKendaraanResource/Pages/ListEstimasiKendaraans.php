<?php

namespace App\Filament\Resources\EstimasiKendaraanResource\Pages;

use App\Filament\Resources\EstimasiKendaraanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEstimasiKendaraans extends ListRecords
{
    protected static string $resource = EstimasiKendaraanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
