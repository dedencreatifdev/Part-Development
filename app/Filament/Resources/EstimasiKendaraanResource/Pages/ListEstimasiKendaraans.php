<?php

namespace App\Filament\Resources\EstimasiKendaraanResource\Pages;

use App\Filament\Resources\EstimasiKendaraanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEstimasiKendaraans extends ListRecords
{
    protected static string $resource = EstimasiKendaraanResource::class;
    protected static ?string $title = 'Finance dashboard';
    protected static string $routePath = 'finance';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
