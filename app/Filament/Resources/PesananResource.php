<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PesananResource\Pages;
use App\Filament\Resources\PesananResource\RelationManagers;
use App\Models\Pelanggan;
use App\Models\Pesanan;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PesananResource extends Resource
{
    protected static ?string $model = Pesanan::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationLabel = 'Pesanan Sparepart';
    protected static ?string $navigationGroup = 'Sparepart';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Section::make()
                //     ->relationship('relPelanggan')
                //     ->schema([
                //         TextInput::make('alamat')
                //             ->disabled()
                //             ->maxLength(100),

                //     ]),
                Select::make('pelanggan_id')
                    ->label('Pelanggan')
                    ->options(Pelanggan::all()->pluck('nama_customer', 'id'))
                    ->searchable(),
                DateTimePicker::make('tanggal_ambil')
                    ->required(),
                TextInput::make('nama_pengambil')
                    ->required()
                    ->maxLength(100),
                DateTimePicker::make('tanggal_datang')
                    ->required(),
                TextInput::make('supplier_id')
                    ->required()
                    ->maxLength(100),
                TextInput::make('lampiran')
                    ->required()
                    ->maxLength(200),
                TextInput::make('uang_muka')
                    ->required()
                    ->numeric(),
            ])
            ->columns(3)
            ->inlineLabel();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('created_at')
                ->label('Tgl Pesan')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('relPelanggan.nama_customer')
                    ->label('Nama Cusromer')
                    ->searchable(),
                TextColumn::make('relPelanggan.alamat')
                    ->label('Alamat')
                    ->size(TextColumn\TextColumnSize::ExtraSmall)
                    ->wrap()
                    ->searchable(),
                TextColumn::make('relPelanggan.no_telp')
                    ->label('No Polisi')
                    ->searchable(),
                TextColumn::make('supplier_id')
                    ->searchable(),
                TextColumn::make('lampiran')
                    ->searchable(),
                TextColumn::make('uang_muka')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPesanans::route('/'),
            'create' => Pages\CreatePesanan::route('/create'),
            'view' => Pages\ViewPesanan::route('/{record}'),
            'edit' => Pages\EditPesanan::route('/{record}/edit'),
        ];
    }
}
