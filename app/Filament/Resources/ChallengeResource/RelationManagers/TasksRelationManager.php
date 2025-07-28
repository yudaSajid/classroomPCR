<?php

namespace App\Filament\Resources\ChallengeResource\RelationManagers;

use App\Models\Task;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class TasksRelationManager extends RelationManager
{
    protected static string $relationship = 'tasks';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Forms\Components\TextInput::make('task_name')
                        ->required(),
                    Forms\Components\FileUpload::make('task_photo')
                        ->image()
                        ->optimize('webp')
                        ->imageEditor()
                        ->directory('task')
                        ->imageEditorEmptyFillColor('#ffffff'),
                    RichEditor::make('task_description')
                        ->required()
                        ->columnSpanFull(),
                ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('task_name')
            ->columns([
                Tables\Columns\ImageColumn::make('task_photo')
                    ->searchable()
                    ->circular(),
                Tables\Columns\TextColumn::make('task_name')
                    ->searchable()
                    ->description(fn (Task $record): string => Str::limit(strip_tags($record->task_description), 100)),

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
