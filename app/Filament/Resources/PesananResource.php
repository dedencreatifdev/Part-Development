<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PesananResource\Pages;
use App\Filament\Resources\PesananResource\RelationManagers;
use App\Models\Pelanggan;
use App\Models\Pesanan;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Symfony\Component\Uid\Uuid;

class PesananResource extends Resource
{
    protected static ?string $model = Pesanan::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationLabel = 'Pesanan';
    protected static ?string $navigationGroup = 'Sparepart';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([
                    Section::make([
                        Select::make('pelanggan_id')
                            ->label('Pelanggan')
                            // ->options(Pelanggan::all()->pluck('nama_customer', 'id'))
                            ->relationship('relPelanggan', 'nama_customer')
                            ->searchable(['nama_customer', 'no_polisi', 'no_telp'])
                            ->searchPrompt('Search Nama Customer by Nama Customer No Polisi dan No Telpon')
                            ->searchingMessage('Searching authors...')
                            ->createOptionForm([
                                TextInput::make('nama_customer')
                                    ->required(),
                                Textarea::make('alamat')
                                    ->required(),
                            ])
                            ->editOptionForm([
                                TextInput::make('nama_customer')
                                    ->required(),
                                Textarea::make('alamat')
                                    ->required(),
                            ])
                            ->required()
                            ->preload()
                            ->searchable(),
                        Textarea::make('alamat')
                            ->readOnly()
                            ->disabled()
                            ->rows(3)
                            ->default('Unit')
                            ->maxLength(200),
                        TextInput::make('no_telp')
                            ->readOnly()
                            ->disabled()
                            ->maxLength(200)
                            ->default('Data'),
                        TextInput::make('type_kendaraan')
                            ->readOnly()
                            ->disabled()
                            ->maxLength(200),

                    ]),
                    Section::make([
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

                    ])->grow(false),
                ])->from('md'),
                Repeater::make('data')
                    ->schema([
                        TextInput::make('name')->required(),
                        TextInput::make('name')->required(),
                        TextInput::make('name')->required(),
                        // ...
                    ]),
                Section::make()
                    ->schema([]),

            ])
            ->columns(1)
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
                // TextColumn::make('relPelanggan.alamat')
                //     ->label('Alamat')
                //     ->size(TextColumn\TextColumnSize::ExtraSmall)
                //     ->wrap()
                //     ->searchable(),
                TextColumn::make('relPelanggan.no_telp')
                    ->label('No Telp')
                    ->searchable(),
                TextColumn::make('supplier_id')
                    ->searchable(),
                TextColumn::make('uang_muka')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                ])
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
