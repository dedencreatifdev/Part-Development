<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdukResource\Pages;
use App\Filament\Resources\ProdukResource\RelationManagers;
use App\Models\Produk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProdukResource extends Resource
{
    protected static ?string $model = Produk::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('KDBR')
                    ->maxLength(100)
                    ->default(null),
                Forms\Components\TextInput::make('NAMA')
                    ->maxLength(50)
                    ->default(null),
                Forms\Components\TextInput::make('PRODUKSI')
                    ->maxLength(50)
                    ->default(null),
                Forms\Components\TextInput::make('KDGROUP')
                    ->maxLength(50)
                    ->default(null),
                Forms\Components\TextInput::make('KDLOKASI')
                    ->maxLength(50)
                    ->default(null),
                Forms\Components\TextInput::make('SATUAN')
                    ->maxLength(50)
                    ->default(null),
                Forms\Components\TextInput::make('HRG_BELI')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('HRG_JUAL')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('HRG_HPP')
                    ->maxLength(50)
                    ->default(null),
                Forms\Components\TextInput::make('DISC_BELI')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('DISC_JUAL')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('QTY_MIN')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('QTY_MAX')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('QTY_ORD')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('MVCD')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('DLCODE')
                    ->maxLength(50)
                    ->default(null),
                Forms\Components\TextInput::make('KDNSB')
                    ->maxLength(50)
                    ->default(null),
                Forms\Components\DatePicker::make('TG_PRICE'),
                Forms\Components\Textarea::make('KETERANGAN')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('KM_PAKAI')
                    ->maxLength(50)
                    ->default(null),
                Forms\Components\TextInput::make('STATUS')
                    ->numeric()
                    ->default(null),
                Forms\Components\DatePicker::make('TG_DAFTAR'),
                Forms\Components\TextInput::make('ID_KODE')
                    ->maxLength(50)
                    ->default(null),
                Forms\Components\TextInput::make('FLAG')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('FT_QTYOB')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('FT_QTYOJ')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('FT_QTYAKHIR')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('FT_HPPAKHIR')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('FT_HPPUNIT')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('FT_NMGROUP')
                    ->maxLength(50)
                    ->default(null),
                Forms\Components\TextInput::make('FT_LOKASI')
                    ->maxLength(50)
                    ->default(null),
                Forms\Components\FileUpload::make('image')
                    ->image(),
                Forms\Components\DateTimePicker::make('tgl_update')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('KDBR')
                    ->searchable(),
                Tables\Columns\TextColumn::make('NAMA')
                    ->searchable(),
                Tables\Columns\TextColumn::make('PRODUKSI')
                    ->searchable(),
                Tables\Columns\TextColumn::make('KDGROUP')
                    ->searchable(),
                Tables\Columns\TextColumn::make('KDLOKASI')
                    ->searchable(),
                Tables\Columns\TextColumn::make('SATUAN')
                    ->searchable(),
                Tables\Columns\TextColumn::make('HRG_BELI')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('HRG_JUAL')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('HRG_HPP')
                    ->searchable(),
                Tables\Columns\TextColumn::make('DISC_BELI')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('DISC_JUAL')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('QTY_MIN')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('QTY_MAX')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('QTY_ORD')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('MVCD')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('DLCODE')
                    ->searchable(),
                Tables\Columns\TextColumn::make('KDNSB')
                    ->searchable(),
                Tables\Columns\TextColumn::make('TG_PRICE')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('KM_PAKAI')
                    ->searchable(),
                Tables\Columns\TextColumn::make('STATUS')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('TG_DAFTAR')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ID_KODE')
                    ->searchable(),
                Tables\Columns\TextColumn::make('FLAG')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('FT_QTYOB')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('FT_QTYOJ')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('FT_QTYAKHIR')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('FT_HPPAKHIR')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('FT_HPPUNIT')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('FT_NMGROUP')
                    ->searchable(),
                Tables\Columns\TextColumn::make('FT_LOKASI')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('tgl_update')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
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
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ManageProduks::route('/'),
        ];
    }
}
