<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KendaraanResource\Pages;
use App\Filament\Resources\KendaraanResource\RelationManagers;
use App\Models\Kendaraan;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KendaraanResource extends Resource
{
    protected static ?string $model = Kendaraan::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationLabel = 'Kendaraan';
    protected static ?string $navigationGroup = 'Service';
    // use HasPageShield;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('no_polisi')
                    ->label('No Polisi')
                    ->prefixIcon('heroicon-o-truck')
                    ->required()
                    ->maxLength(255),
                TextInput::make('kdnsb')
                    ->label('Kode Nasabah')
                    ->maxLength(255)
                    ->default(null),
                TextInput::make('kdjns')
                    ->label('Kode Jenis')
                    ->maxLength(255)
                    ->default(null),
                TextInput::make('kendaraan')
                    ->label('Kendaraan')
                    ->columnSpanFull()
                    ->maxLength(255)
                    ->default(null),
                TextInput::make('kdtype')
                    ->label('Kode Type')
                    ->maxLength(255)
                    ->default(null),
                TextInput::make('no_chasis')
                    ->label('Nomor Chasis')
                    ->maxLength(255)
                    ->default(null),
                TextInput::make('no_mesin')
                    ->label('Nomor Mesin')
                    ->maxLength(255)
                    ->default(null),
                TextInput::make('no_seri')
                    ->maxLength(255)
                    ->default(null),
                TextInput::make('tahun'),
                TextInput::make('warna')
                    ->maxLength(255)
                    ->default(null),
                TextInput::make('no_bpkb')
                    ->maxLength(255)
                    ->default(null),
                TextInput::make('no_faktur')
                    ->maxLength(255)
                    ->default(null),
                DatePicker::make('tg_stnk'),
                TextInput::make('atasnama')
                    ->maxLength(255)
                    ->default(null),
                Textarea::make('alamat')
                    ->rows(5)
                    ->columnSpanFull(),
                TextInput::make('km_akhir')
                    ->numeric()
                    ->default(null),
                TextInput::make('km_hari')
                    ->numeric()
                    ->default(null),
                DatePicker::make('tg_jual'),
                Textarea::make('keterangan')
                    ->columnSpanFull(),
                DatePicker::make('tg_daftar'),
                TextInput::make('id_kode')
                    ->maxLength(255)
                    ->default(null),
                TextInput::make('id_comp')
                    ->maxLength(255)
                    ->default(null),
                Toggle::make('flag')
                    ->required(),
                TextInput::make('ft_nmpemilik')
                    ->maxLength(255)
                    ->default(null),
                TextInput::make('ft_jnskend')
                    ->maxLength(255)
                    ->default(null),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('no_polisi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kdjns')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kendaraan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kdtype')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_chasis')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_mesin')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tahun'),
            ])
            ->striped()
            ->paginated([20, 50, 100, 'all'])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->label('Detail')
                        ->icon('heroicon-o-clipboard-document-list')
                        ->color('success'),
                    Tables\Actions\EditAction::make()
                        ->label('Ubah')
                        // ->icon('heroicon-o-clipboard-document-list')
                        ->color('warning'),
                    Tables\Actions\DeleteAction::make()
                        ->label('Hapus')
                        // ->icon('heroicon-o-clipboard-document-list')
                        ->color('danger'),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageKendaraans::route('/'),
        ];
    }
}
