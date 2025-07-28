<?php

namespace App\Filament\Resources;

use App\Enums\ImageType;
use App\Filament\Resources\ImageResource\Pages;
use App\Models\Image;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ImageResource extends Resource
{
    protected static ?string $model = Image::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('type')
                    ->options(ImageType::toSelectArray()) // Opsi dari enum ImageType
                    ->required()
                    ->reactive() // Membuatnya bisa bereaksi terhadap perubahan
                    ->afterStateUpdated(function ($state, callable $set) {
                        // Memodifikasi 'name' secara otomatis berdasarkan 'type' yang dipilih
                        if ($state) {
                            $set('name', strtolower($state).'-'); // Set format name berdasarkan type
                        }
                    }),

                // TextInput untuk name yang akan otomatis terisi
                TextInput::make('name')
                    ->required()
                    ->unique()
                    ->reactive(), // Menjadikan input ini dapat direaksi untuk perubahan state di form

                Forms\Components\FileUpload::make('path')
                    ->label('Image File')
                    ->image()
                    ->optimize('webp')
                    ->imageEditor()
                    ->directory('images')
                    ->imageEditorEmptyFillColor('#000000')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->groups([
                'type',
            ])
            ->columns([
                Split::make([
                    Stack::make([
                        Tables\Columns\ImageColumn::make('path')
                            ->circular()
                            ->size(50)
                            ->searchable(),
                        TextColumn::make('name')
                            ->searchable(),
                    ]),

                    Tables\Columns\TextColumn::make('type')
                        ->formatStateUsing(function ($state) {
                            return ImageType::toSelectArray()[$state] ?? $state;
                        })
                        ->badge()
                        ->colors([
                            'primary' => ImageType::Profile,   // Menggunakan enum sebagai kunci warna
                            'success' => ImageType::Thumbnail,      // Menggunakan enum sebagai kunci warna
                            'danger' => ImageType::GIF,      // Menggunakan enum sebagai kunci warna
                        ])
                        ->searchable(),

                ]),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListImages::route('/'),
            // 'create' => Pages\CreateImage::route('/create'),
            // 'edit' => Pages\EditImage::route('/{record}/edit'),
        ];
    }
}
