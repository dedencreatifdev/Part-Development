<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PesananResource\Pages;
use App\Filament\Resources\PesananResource\RelationManagers;
use App\Models\Pesanan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PesananResource extends Resource
{
    protected static ?string $model = Pesanan::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationLabel = 'Pesanan Sparepart';
    protected static ?string $navigationGroup = 'Sparepart';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('pelanggan_id')
                    ->required()
                    ->maxLength(100),
                Forms\Components\DateTimePicker::make('tanggal_ambil')
                    ->required(),
                Forms\Components\TextInput::make('nama_pengambil')
                    ->required()
                    ->maxLength(100),
                Forms\Components\DateTimePicker::make('tanggal_datang')
                    ->required(),
                Forms\Components\TextInput::make('supplier_id')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('lampiran')
                    ->required()
                    ->maxLength(200),
                Forms\Components\TextInput::make('uang_muka')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('pelanggan_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_ambil')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama_pengambil')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_datang')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('supplier_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lampiran')
                    ->searchable(),
                Tables\Columns\TextColumn::make('uang_muka')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
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
