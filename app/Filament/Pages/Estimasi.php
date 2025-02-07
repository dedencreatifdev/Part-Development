<?php

namespace App\Filament\Pages;

use App\Models\Kendaraan;
use Filament\Pages\Page;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\WithPagination;

class Estimasi extends Page implements HasTable
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Daftar Estimasi';
    protected static ?string $navigationGroup = 'Service';
    protected static ?string $title = 'Daftar Estimasi';
    protected ?string $subheading = 'Custom Page Subheading';

    protected static string $view = 'filament.pages.estimasi';

    use InteractsWithTable;

    public static function table(Table $table): Table
    {
        return $table
            ->description('Daftar Harga Produk MITSUBISHI Budi Berlian Motor')
            ->query(Kendaraan::latest())
            ->columns([
                TextColumn::make('KDBR')
                    ->label('Kode Barang')
                    ->size(TextColumn\TextColumnSize::ExtraSmall)
                    ->weight(FontWeight::Bold)
                    ->sortable()
                    ->searchable(),
            ]);
    }
}
