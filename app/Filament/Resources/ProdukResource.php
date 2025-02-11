<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdukResource\Pages;
use App\Filament\Resources\ProdukResource\RelationManagers;
use App\Filament\Resources\ProdukResource\RelationManagers\ProdukRelationManager;
use App\Models\Produk;
use DateTime;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
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

    // protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?string $navigationLabel = 'Produk List';
    protected static ?string $navigationGroup = 'Sparepart';
    protected static ?int $navigationSort = 1;

    // public static function getEloquentQuery(): Builder
    // {
    //     return parent::getEloquentQuery()->whereNot('FT_NMGROUP', 'sm');
    // }

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
            ->description('Daftar Harga Produk MITSUBISHI')
            ->columns([
                Stack::make([
                    // Columns
                    ImageColumn::make('avatar')
                        ->size('100%')
                        ->defaultImageUrl(url('https://budiberlianmotor.co.id/wp-content/uploads/logo-wa-scaled.jpg')),
                    TextColumn::make('KDBR')
                        ->label('Kode Barang')
                        ->size(TextColumn\TextColumnSize::ExtraSmall)
                        ->weight(FontWeight::Bold)
                        ->searchable(),
                    TextColumn::make('NAMA')
                        ->label('Nama Barang')
                        ->size(TextColumn\TextColumnSize::ExtraSmall)
                        ->limit(15)
                        ->searchable(),
                    TextColumn::make('KDGROUP')
                        ->prefix('Grup : ')
                        ->label('Grup')
                        ->size(TextColumn\TextColumnSize::ExtraSmall)
                        ->searchable(),
                    TextColumn::make('relLokasiRak.rak')
                        ->prefix('Lokasi : ')
                        ->suffix(' (Tuba)')
                        ->default('-')
                        ->size(TextColumn\TextColumnSize::ExtraSmall),
                    TextColumn::make('SATUAN')
                        ->prefix('Satuan : ')
                        ->size(TextColumn\TextColumnSize::ExtraSmall),
                    TextColumn::make('HRG_JUAL')
                        ->prefix('Rp ')
                        ->size(TextColumn\TextColumnSize::ExtraSmall)
                        ->weight(FontWeight::Bold)
                        ->numeric(),
                    TextColumn::make('KETERANGAN')
                        ->prefix('Part Rel : ')
                        ->size(TextColumn\TextColumnSize::ExtraSmall),
                ]),
            ])
            ->contentGrid([
                'default' => 2,
                'sm' => 3,
                'md' => 3,
                'lg' => 4,
                'xl' => 6,
                '2xl' => 7,
            ])
            // ->groups([
            //     'KDGROUP',
            // ])
            // ->defaultGroup('FT_NMGROUP')

            ->paginated([28, 42, 56, 70, 'all'])

            ->filters([
                // SelectFilter::make('status')
                //     ->multiple()
                //     ->options([
                //         'draft' => 'Draft',
                //         'reviewing' => 'Reviewing',
                //         'published' => 'Published',
                //     ])
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make()
                    ->size(ActionSize::ExtraSmall)
                    ->label('Lihat Detail')
                    ->icon('heroicon-o-clipboard-document-list')
                    ->color('primary'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ProdukRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProduks::route('/'),
            'create' => Pages\CreateProduk::route('/create'),
            'view' => Pages\ViewProduk::route('/{record}'),
            'edit' => Pages\EditProduk::route('/{record}/edit'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Split::make([
                    Section::make([
                        ImageEntry::make('image')
                            ->label('')
                            // ->columnSpanFull()
                            // ->size('100%')
                            ->defaultImageUrl(url('https://budiberlianmotor.co.id/wp-content/uploads/logo-wa-scaled.jpg')),
                    ])->grow(false),
                    Section::make([
                        TextEntry::make('KDBR')
                            ->size(TextEntry\TextEntrySize::ExtraSmall)
                            ->label('Kode Barang'),
                        TextEntry::make('NAMA')
                            ->size(TextEntry\TextEntrySize::ExtraSmall)
                            ->label('Nama Barang'),
                        TextEntry::make('KDGROUP')
                            ->size(TextEntry\TextEntrySize::ExtraSmall)
                            ->label('Group'),
                        TextEntry::make('relLokasiRak.rak')
                            ->size(TextEntry\TextEntrySize::ExtraSmall)
                            ->label('Lokasi'),
                        TextEntry::make('SATUAN')
                            ->size(TextEntry\TextEntrySize::ExtraSmall)
                            ->label('Satuan'),
                        TextEntry::make('HRG_JUAL')
                            ->size(TextEntry\TextEntrySize::ExtraSmall)
                            ->prefix('Rp ')
                            ->numeric(2)
                            ->label('Harga'),

                        TextEntry::make('KETERANGAN')
                            ->size(TextEntry\TextEntrySize::ExtraSmall)
                            ->label('Keterangan'),
                        TextEntry::make('ID_KODE')
                            ->size(TextEntry\TextEntrySize::ExtraSmall)
                            ->label('Status'),
                        TextEntry::make('TG_DAFTAR')
                            ->label('Registered')
                            ->dateTime(),
                        // TextEntry::make('relProduk')
                        //     ->label('Registered')
                    ])->columns(1),

                ])->from('md'),

                // Section::make()
                //     ->description('Kode Part Pengganti')
                //     ->relationship('relProduk')
                //     ->schema([
                //         TextEntry::make('NAMA'),

                //     ]),
            ])
            ->columns(1)
            ->inlineLabel()
        ;
    }
}
