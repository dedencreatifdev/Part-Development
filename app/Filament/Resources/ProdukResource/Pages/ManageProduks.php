<?php

namespace App\Filament\Resources\ProdukResource\Pages;

use App\Filament\Resources\ProdukResource;
use App\Filament\Widgets\DashboardOverview;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageProduks extends ManageRecords
{
    protected static string $resource = ProdukResource::class;
    protected static ?string $label = 'Produk';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            // DashboardOverview::class
        ];
    }

    protected function getShieldRedirectPath(): string
    {
        return '/'; // redirect to the root index...
    }
}
