<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PeriodResource\Pages;
use App\Filament\Resources\PeriodResource\RelationManagers\SemestersRelationManager;
use App\Models\Period;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PeriodResource extends Resource
{
    protected static ?string $model = Period::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $activeNavigationIcon = 'heroicon-s-calendar-days';

    protected static ?string $navigationGroup = 'Education Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Forms\Components\TextInput::make('period_name')
                        ->required()
                        ->maxLength(255),
                    Fieldset::make('Date Range')->schema([
                        DatePicker::make('period_start')
                            ->label('Start Period')
                            ->required()
                            ->reactive(),

                        DatePicker::make('period_end')
                            ->label('End Period')
                            ->required()
                            ->afterOrEqual('period_start')
                            ->reactive()
                            ->afterStateUpdated(function (callable $get, callable $set) {
                                if ($get('period_start') > $get('period_end')) {
                                    $set('period_end', null);
                                }
                            }),
                    ])->columns(2)
                        ->reactive()
                        ->afterStateUpdated(function (callable $get, callable $set) {
                            if ($get('period_start') && $get('period_end') && $get('period_start') > $get('period_end')) {
                                $set('period_end', null);
                            }
                        }),

                ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('period_name')
                    ->searchable(),
                TextColumn::make('semesters.semester_name')
                    ->badge()
                    ->separator(','),
                Tables\Columns\TextColumn::make('period_start')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('period_end')
                    ->date()
                    ->sortable(),
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
            SemestersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPeriods::route('/'),
            'create' => Pages\CreatePeriod::route('/create'),
            'edit' => Pages\EditPeriod::route('/{record}/edit'),
        ];
    }
}
