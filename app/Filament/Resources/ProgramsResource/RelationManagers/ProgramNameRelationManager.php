<?php

namespace App\Filament\Resources\ProgramsResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProgramNameRelationManager extends RelationManager
{
    protected static string $relationship = 'programs';

    public function form(Form $form): Form
    {
        $Id = $this->ownerRecord->id;

        return $form
            ->schema([
                Forms\Components\Select::make('department_id')
                    ->relationship('department', 'department_name')
                    ->required()
                    ->default($Id),
                Forms\Components\TextInput::make('program_name')
                    ->required()
                    ->live(debounce: 500)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('program_slug', Str::slug($state)))
                    ->maxLength(255),
                Forms\Components\TextInput::make('program_slug')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('program_name')
            ->columns([
                Tables\Columns\TextColumn::make('program_name'),
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
