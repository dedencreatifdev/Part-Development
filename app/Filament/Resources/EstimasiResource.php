<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EstimasiResource\Pages;
use App\Filament\Resources\EstimasiResource\RelationManagers;
use App\Models\Estimasi;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn\TextColumnSize;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EstimasiResource extends Resource
{
    protected static ?string $model = Estimasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Estimasi';
    protected static ?string $navigationGroup = 'Service';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([


                Split::make([
                    Section::make([
                        TextInput::make('nama_estimasi')
                            ->required()
                            ->maxLength(100),
                        FileUpload::make('image')
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                null,
                                '1:1',
                            ])
                            ->image()
                            ->required(),
                    ])->grow(false),
                    Section::make([
                        //
                    ]),
                ])->from('md')
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Stack::make([
                    Tables\Columns\ImageColumn::make('image')
                        // ->acceptedFileTypes(['storage'])
                        // ->storeFiles(false)
                        // ->moveFiles()
                        // ->defaultImageUrl(fn(Estimasi $record) => url('storage/app/public') . '/' . $record->image)
                        ->size('100%'),
                    Tables\Columns\TextColumn::make('nama_estimasi')
                        ->size(TextColumnSize::ExtraSmall)
                        ->weight(FontWeight::Bold)
                        ->alignCenter()
                        ->limit(20)
                        ->searchable(),

                ]),
            ])
            ->contentGrid([
                'default' => 2,
                'sm' => 3,
                'md' => 3,
                'lg' => 4,
                'xl' => 6,
                '2xl' => 8,
                '3xl' => 10,
                '4xl' => 12,
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
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\RelEstimasiKendaraanRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEstimasis::route('/'),
            'create' => Pages\CreateEstimasi::route('/create'),
            'view' => Pages\ViewEstimasi::route('/{record}'),
            'edit' => Pages\EditEstimasi::route('/{record}/edit'),
        ];
    }
}
