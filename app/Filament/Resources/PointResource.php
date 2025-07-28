<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PointResource\Pages;
use App\Models\Point;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PointResource extends Resource
{
    protected static ?string $model = Point::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?string $navigationGroup = 'Achievement';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([

                    Forms\Components\Grid::make(2)
                        ->schema([
                            Forms\Components\Section::make('User Information')
                                ->schema([
                                    Forms\Components\Select::make('user_id')
                                        ->required()
                                        ->searchable()
                                        ->relationship('user', 'name')
                                        ->label('User Name'),
                                    Forms\Components\TextInput::make('points')
                                        ->required()
                                        ->numeric()
                                        ->label('Points Earned'),
                                ]),
                            Forms\Components\Section::make('Activity Details')
                                ->schema([
                                    Select::make('course_id')
                                        ->searchable()
                                        ->relationship('course', 'course_name')
                                        ->label('Course'),
                                    Select::make('quiz_id')
                                        ->searchable()
                                        ->relationship('quiz', 'title')
                                        ->label('Quiz'),
                                    Forms\Components\TextInput::make('reason')
                                        ->maxLength(255)
                                        ->default(null)
                                        ->placeholder('Enter reason for points')
                                        ->columnSpanFull(),
                                ]),
                        ])
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->groups([
                'user.name',
            ])
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable(),
                TextColumn::make('points')
                    ->label('Points')
                    ->numeric()
                    ->sortable()
                    ->summarize(Sum::make()),
                Tables\Columns\TextColumn::make('reason')
                    ->searchable(),
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
                SelectFilter::make('user')
                    ->relationship('user', 'name'),
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
            'index' => Pages\ListPoints::route('/'),
            'create' => Pages\CreatePoint::route('/create'),
            'edit' => Pages\EditPoint::route('/{record}/edit'),
        ];
    }
}
