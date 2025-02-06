<?php

namespace App\Filament\Resources\PesananResource\Pages;

use App\Filament\Resources\PesananResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPesanans extends ListRecords
{
    protected static string $resource = PesananResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('import_pesanan')
            ->hidden()
            ,
        ];
    }

    protected function getShieldRedirectPath(): string {
        return '/'; // redirect to the root index...
    }
}
