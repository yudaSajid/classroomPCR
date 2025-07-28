<?php

namespace App\Filament\Resources\PeriodResource\RelationManagers;

use App\Models\Period;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class SemestersRelationManager extends RelationManager
{
    protected static string $relationship = 'semesters';

    public function form(Form $form): Form
    {
        $Id = $this->ownerRecord->id;

        return $form
            ->schema([
                Section::make()->schema([
                    Select::make('period_id')
                        ->required()
                        ->default($Id)
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('semester_name')
            ->columns([
                Tables\Columns\TextColumn::make('semester_name'),
                Tables\Columns\TextColumn::make('semester_start')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('semester_end')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
