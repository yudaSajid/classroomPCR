<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PointSettingResource\Pages;
use App\Models\PointSetting;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PointSettingResource extends Resource
{
    protected static ?string $model = PointSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-8-tooth';

    protected static ?string $activeNavigationIcon = 'heroicon-s-cog-8-tooth';

    protected static ?string $navigationGroup = 'Achievement';

    protected static ?string $navigationParentItem = 'Points';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Forms\Components\TextInput::make('model_name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('event')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('points')
                        ->required()
                        ->numeric(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('model_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('event')
                    ->searchable(),
                Tables\Columns\TextColumn::make('points')
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPointSettings::route('/'),
            'create' => Pages\CreatePointSetting::route('/create'),
            'edit' => Pages\EditPointSetting::route('/{record}/edit'),
        ];
    }
}
