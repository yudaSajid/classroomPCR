<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SemesterResource\Pages;
use App\Models\Period;
use App\Models\Semester;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SemesterResource extends Resource
{
    protected static ?string $model = Semester::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationGroup = 'Education Management';

    protected static ?string $navigationParentItem = 'Periods';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Select::make('period_id')
                        ->required()
                        ->relationship('period', 'period_name')
                        ->reactive()
                        ->afterStateUpdated(function (callable $get, callable $set) {
                            $set('semester_start', null);
                            $set('semester_end', null);
                        }),
                    Forms\Components\TextInput::make('semester_name')
                        ->required()
                        ->maxLength(255),
                    Fieldset::make('Date Range')->schema([
                        DatePicker::make('semester_start')
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function (callable $get, callable $set) {
                                $period = Period::find($get('period_id'));
                                if ($period) {
                                    if ($get('semester_start') < $period->period_start || $get('semester_start') > $period->period_end) {
                                        $set('semester_start', null);
                                    }
                                }
                            }),
                        DatePicker::make('semester_end')
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function (callable $get, callable $set) {
                                $period = Period::find($get('period_id'));
                                if ($period) {
                                    if ($get('semester_end') < $period->period_start || $get('semester_end') > $period->period_end) {
                                        $set('semester_end', null);
                                    }
                                }
                            }),
                    ])
                        ->afterStateUpdated(function (callable $get, callable $set) {
                            $period = Period::find($get('period_id'));
                            if ($period) {
                                if ($get('semester_start') < $period->period_start || $get('semester_start') > $period->period_end) {
                                    $set('semester_start', null);
                                }
                                if ($get('semester_end') < $period->period_start || $get('semester_end') > $period->period_end) {
                                    $set('semester_end', null);
                                }
                            }
                        }),
                    Forms\Components\RichEditor::make('semester_description')
                        ->maxLength(255)
                        ->default(null),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->groups([
                'period.period_name',
            ])
            ->columns([
                Tables\Columns\TextColumn::make('semester_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('semester_start')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('semester_end')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('period.period_name')
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSemesters::route('/'),
            'create' => Pages\CreateSemester::route('/create'),
            'edit' => Pages\EditSemester::route('/{record}/edit'),
        ];
    }
}
