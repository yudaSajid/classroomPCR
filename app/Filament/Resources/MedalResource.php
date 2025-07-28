<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MedalResource\Pages;
use App\Filament\Resources\MedalResource\RelationManagers\UsersRelationManager;
use App\Models\Medal;
use Filament\Forms;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MedalResource extends Resource
{
    protected static ?string $model = Medal::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';

    protected static ?string $activeNavigationIcon = 'heroicon-s-gift';

    protected static ?string $navigationGroup = 'Achievement';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([

                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\RichEditor::make('description')
                        ->required()
                        ->maxLength(255),
                ])->columnSpan(2),
                Group::make([
                    Section::make([
                        ColorPicker::make('color')
                            ->required(),
                        TextInput::make('points')
                            ->integer()
                            ->step(50),
                    ]),
                    Section::make([
                        Forms\Components\FileUpload::make('medal_image')
                            ->image()
                            ->optimize('webp')
                            ->imageEditor()
                            ->directory('medals')
                            ->imageEditorEmptyFillColor('#ffffff')
                            ->required(),
                    ])->collapsible(),
                ])->columnSpan(2),
            ])->columns(4);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('medal_image')
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->description(fn (Medal $record): string => '>= '.$record->points),
                Tables\Columns\ColorColumn::make('color')
                    ->searchable(),
                TextColumn::make('users_count')->counts('users')
                    ->alignCenter()
                    ->label('Has Rewarded'),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            UsersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMedals::route('/'),
            'create' => Pages\CreateMedal::route('/create'),
            'edit' => Pages\EditMedal::route('/{record}/edit'),
        ];
    }
}
