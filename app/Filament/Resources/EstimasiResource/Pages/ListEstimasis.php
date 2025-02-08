<?php

namespace App\Filament\Resources\EstimasiResource\Pages;

use App\Filament\Resources\EstimasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEstimasis extends ListRecords
{
    protected static string $resource = EstimasiResource::class;
    protected static ?string $label = 'Daftar Estimasi';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
