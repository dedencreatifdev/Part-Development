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

class Estimasi extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Daftar Estimasi';
    protected static ?string $navigationGroup = 'Service';
    protected static ?string $title = 'Daftar Estimasi';
    protected ?string $subheading = 'Custom Page Subheading';

    protected static string $view = 'filament.pages.estimasi';
}
