<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdukResource\Pages;
use App\Filament\Resources\ProdukResource\RelationManagers;
use App\Models\Produk;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
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
                TextInput::make('KDBR')
                    ->maxLength(100)
                    ->default(null),
                TextInput::make('NAMA')
                    ->maxLength(50)
                    ->default(null),
                TextInput::make('PRODUKSI')
                    ->maxLength(50)
                    ->default(null),
                TextInput::make('KDGROUP')
                    ->maxLength(50)
                    ->default(null),
                TextInput::make('KDLOKASI')
                    ->maxLength(50)
                    ->default(null),
                TextInput::make('SATUAN')
                    ->maxLength(50)
                    ->default(null),
                TextInput::make('HRG_BELI')
                    ->numeric()
                    ->default(null),
                TextInput::make('HRG_JUAL')
                    ->numeric()
                    ->default(null),
                TextInput::make('HRG_HPP')
                    ->maxLength(50)
                    ->default(null),
                TextInput::make('DISC_BELI')
                    ->numeric()
                    ->default(null),
                TextInput::make('DISC_JUAL')
                    ->numeric()
                    ->default(null),
                TextInput::make('QTY_MIN')
                    ->numeric()
                    ->default(null),
                TextInput::make('QTY_MAX')
                    ->numeric()
                    ->default(null),
                TextInput::make('QTY_ORD')
                    ->numeric()
                    ->default(null),
                TextInput::make('MVCD')
                    ->numeric()
                    ->default(null),
                TextInput::make('DLCODE')
                    ->maxLength(50)
                    ->default(null),
                TextInput::make('KDNSB')
                    ->maxLength(50)
                    ->default(null),
                DatePicker::make('TG_PRICE'),
                Textarea::make('KETERANGAN')
                    ->columnSpanFull(),
                TextInput::make('KM_PAKAI')
                    ->maxLength(50)
                    ->default(null),
                TextInput::make('STATUS')
                    ->numeric()
                    ->default(null),
                DatePicker::make('TG_DAFTAR'),
                TextInput::make('ID_KODE')
                    ->maxLength(50)
                    ->default(null),
                TextInput::make('FLAG')
                    ->numeric()
                    ->default(null),
                TextInput::make('FT_QTYOB')
                    ->numeric()
                    ->default(null),
                TextInput::make('FT_QTYOJ')
                    ->numeric()
                    ->default(null),
                TextInput::make('FT_QTYAKHIR')
                    ->numeric()
                    ->default(null),
                TextInput::make('FT_HPPAKHIR')
                    ->numeric()
                    ->default(null),
                TextInput::make('FT_HPPUNIT')
                    ->numeric()
                    ->default(null),
                TextInput::make('FT_NMGROUP')
                    ->maxLength(50)
                    ->default(null),
                TextInput::make('FT_LOKASI')
                    ->maxLength(50)
                    ->default(null),
                FileUpload::make('image')
                    ->image(),
                DateTimePicker::make('tgl_update')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Stack::make([
                    // Columns
                    ImageColumn::make('avatar')
                        ->size('100%')
                        ->defaultImageUrl(url('https://budiberlianmotor.co.id/wp-content/uploads/logo-wa-scaled.jpg')),
                    TextColumn::make('KDBR')
                        ->size(TextColumn\TextColumnSize::ExtraSmall)
                        ->weight(FontWeight::Bold)
                        ->sortable()
                        ->searchable(),
                    TextColumn::make('NAMA')
                        ->size(TextColumn\TextColumnSize::ExtraSmall)
                        ->limit(15)
                        ->searchable(),
                    TextColumn::make('KDGROUP')
                        ->size(TextColumn\TextColumnSize::ExtraSmall)
                        ->searchable(),
                    TextColumn::make('KDLOKASI')
                        ->size(TextColumn\TextColumnSize::ExtraSmall)
                        ->searchable(),
                    TextColumn::make('SATUAN')
                        ->size(TextColumn\TextColumnSize::ExtraSmall)
                        ->searchable(),
                    TextColumn::make('HRG_JUAL')
                        ->size(TextColumn\TextColumnSize::ExtraSmall)
                        ->weight(FontWeight::Bold)
                        ->numeric(),
                ]),
            ])
            ->contentGrid([
                'default' => 2,
                'md' => 3,
                'lg' => 4,
                'xl' => 4,
                '2xl' => 5,
            ])
            ->paginated([25, 50, 100, 'all'])

            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
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
