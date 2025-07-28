<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BadgeResource\Pages;
use App\Filament\Resources\BadgeResource\RelationManagers\UsersRelationManager;
use App\Models\Badge;
use Filament\Forms;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class BadgeResource extends Resource
{
    protected static ?string $model = Badge::class;

    protected static ?string $navigationIcon = 'heroicon-o-check-badge';

    protected static ?string $activeNavigationIcon = 'heroicon-s-check-badge';

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
                            Forms\Components\TextInput::make('point_require')
                            ->required()
                            ->numeric()
                            ->helperText('Point required to get this badge'),
                    ]),
                    Section::make([
                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->required()
                            ->directory('badge')
                            ->optimize('webp')
                            ->imageEditor()
                            ->imageEditorEmptyFillColor('#ffffff'),
                    ]),
                ])->columnSpan(2),
            ])->columns(4);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->description(fn (Badge $record): string => Str::limit(strip_tags($record->description), 100)),
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
            'index' => Pages\ListBadges::route('/'),
            'create' => Pages\CreateBadge::route('/create'),
            'edit' => Pages\EditBadge::route('/{record}/edit'),
        ];
    }
}
