<?php

namespace App\Filament\Widgets;

use App\Models\Produk;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Support\Enums\ActionSize;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;

class ProdukListTable extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 3;
    // use HasPageShield;
    use HasWidgetShield;

    // use InteractsWithForms, InteractsWithViews, InteractsWithTable;

    // public static function form(Form $form): Form
    // {
    //     return $form
    //         ->schema([
    //             FileUpload::make('image')
    //                 ->columnSpanFull()
    //                 ->image(),
    //             TextInput::make('KDBR')
    //                 ->label('Kode Barang')
    //                 ->maxLength(100)
    //                 ->default(null),
    //             TextInput::make('NAMA')
    //                 ->label('Nama Barang')
    //                 ->maxLength(50)
    //                 ->default(null),
    //             TextInput::make('PRODUKSI')
    //                 ->maxLength(50)
    //                 ->default(null),
    //             TextInput::make('KDGROUP')
    //                 ->maxLength(50)
    //                 ->default(null),
    //             TextInput::make('KDLOKASI')
    //                 ->maxLength(50)
    //                 ->default(null),
    //             TextInput::make('SATUAN')
    //                 ->maxLength(50)
    //                 ->default(null),
    //             TextInput::make('HRG_BELI')
    //                 ->numeric()
    //                 ->default(null),
    //             TextInput::make('HRG_JUAL')
    //                 ->numeric()
    //                 ->default(null),


    //             // TextInput::make('HRG_HPP')
    //             //     ->maxLength(50)
    //             //     ->default(null),
    //             // TextInput::make('DISC_BELI')
    //             //     ->numeric()
    //             //     ->default(null),
    //             // TextInput::make('DISC_JUAL')
    //             //     ->numeric()
    //             //     ->default(null),
    //             // TextInput::make('QTY_MIN')
    //             //     ->numeric()
    //             //     ->default(null),
    //             // TextInput::make('QTY_MAX')
    //             //     ->numeric()
    //             //     ->default(null),
    //             // TextInput::make('QTY_ORD')
    //             //     ->numeric()
    //             //     ->default(null),
    //             // TextInput::make('MVCD')
    //             //     ->numeric()
    //             //     ->default(null),
    //             // TextInput::make('DLCODE')
    //             //     ->maxLength(50)
    //             //     ->default(null),
    //             // TextInput::make('KDNSB')
    //             //     ->maxLength(50)
    //             //     ->default(null),
    //             // DatePicker::make('TG_PRICE'),
    //             // Textarea::make('KETERANGAN')
    //             //     ->columnSpanFull(),
    //             // TextInput::make('KM_PAKAI')
    //             //     ->maxLength(50)
    //             //     ->default(null),
    //             // TextInput::make('STATUS')
    //             //     ->numeric()
    //             //     ->default(null),
    //             // DatePicker::make('TG_DAFTAR'),
    //             // TextInput::make('ID_KODE')
    //             //     ->maxLength(50)
    //             //     ->default(null),
    //             // TextInput::make('FLAG')
    //             //     ->numeric()
    //             //     ->default(null),
    //             // TextInput::make('FT_QTYOB')
    //             //     ->numeric()
    //             //     ->default(null),
    //             // TextInput::make('FT_QTYOJ')
    //             //     ->numeric()
    //             //     ->default(null),
    //             // TextInput::make('FT_QTYAKHIR')
    //             //     ->numeric()
    //             //     ->default(null),
    //             // TextInput::make('FT_HPPAKHIR')
    //             //     ->numeric()
    //             //     ->default(null),
    //             // TextInput::make('FT_HPPUNIT')
    //             //     ->numeric()
    //             //     ->default(null),
    //             // TextInput::make('FT_NMGROUP')
    //             //     ->maxLength(50)
    //             //     ->default(null),
    //             // TextInput::make('FT_LOKASI')
    //             //     ->maxLength(50)
    //             //     ->default(null),

    //             // DateTimePicker::make('tgl_update')
    //             //     ->required(),
    //         ])
    //         ->columns(4);
    // }

    public function table(Table $table): Table
    {
        return $table
            ->heading('')
            ->description('Daftar Harga Sparepart MITSUBISHI')
            ->headerActions([
                Action::make('lihat_semua')
                    // ->badge()
                    // ->badgeIconPosition()
                    // ->badgeColor('primary')
                    // ->badgeIcon('heroicon-o-clipboard-document-list')
                    ->button()
                    ->icon('heroicon-o-clipboard-document-list')
                    ->url(route('filament.admin.resources.produks.index'))
                    ->size(ActionSize::ExtraSmall),
            ])
            ->query(
                // ...
                Produk::query()
            )
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

                        // ->searchable()
                        ,
                    TextColumn::make('NAMA')
                        ->label('Nama Barang')
                        ->size(TextColumn\TextColumnSize::ExtraSmall)

                        ->limit(15)
                        // ->searchable()
                        ,
                    TextColumn::make('KDGROUP')
                        ->badge()
                        ->label('Grup')
                        ->size(TextColumn\TextColumnSize::ExtraSmall)
                    // ->searchable()
                    ,
                    TextColumn::make('relLokasiRak.rak')
                        ->prefix('Lokasi : ')
                        ->suffix('(Tuba)')
                        ->default('-')
                        ->size(TextColumn\TextColumnSize::ExtraSmall),
                    TextColumn::make('SATUAN')
                        ->size(TextColumn\TextColumnSize::ExtraSmall),
                    TextColumn::make('HRG_JUAL')
                        ->prefix('Rp ')
                        ->size(TextColumn\TextColumnSize::ExtraSmall)
                        ->weight(FontWeight::Bold)
                        ->numeric(),
                ]),
            ])
            ->contentGrid([
                'default' => 2,
                'md' => 4,
                'lg' => 5,
                'xl' => 6,
                '2xl' => 8,
            ])
            ->paginated([8, 16, 33, 40, 50, 100, 'all'])
            // ->paginated(false)
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
                // Tables\Actions\ViewAction::make()
                //     ->size(ActionSize::ExtraSmall)
                //     ->label('Lihat Detail')
                //     ->icon('heroicon-o-clipboard-document-list')
                //     ->color('primary'),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                ImageEntry::make('image')
                    ->label('')
                    ->columnSpanFull()
                    ->size('50%')
                    ->defaultImageUrl(url('https://budiberlianmotor.co.id/wp-content/uploads/logo-wa-scaled.jpg')),
                Section::make()
                    ->description('Produk Detail')
                    ->schema([
                        // ...
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
                    ])
                    ->columns(2),
                Section::make()
                    ->description('Riawayat Produk')
                    ->schema([]),
            ])
            ->inlineLabel();
    }
}
