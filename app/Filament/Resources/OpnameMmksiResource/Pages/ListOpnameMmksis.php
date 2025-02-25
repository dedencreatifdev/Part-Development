<?php

namespace App\Filament\Resources\OpnameMmksiResource\Pages;

use App\Filament\Resources\OpnameMmksiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOpnameMmksis extends ListRecords
{
    protected static string $resource = OpnameMmksiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
