<?php

namespace App\Filament\Resources\QuizResource\RelationManagers;

use App\Models\Question;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class QuestionsRelationManager extends RelationManager
{
    protected static string $relationship = 'questions';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([

                    Forms\Components\TextInput::make('question_text')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\FileUpload::make('question_image')
                        ->image()
                        ->optimize('webp')
                        ->imageEditor()
                        ->directory('question')
                        ->imageEditorEmptyFillColor('#ffffff'),
                ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('question_text')
            ->columns([
                Tables\Columns\TextColumn::make('question_text'),
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
                Tables\Actions\Action::make('Jawaban')
                    ->label('Answer')
                    ->icon('heroicon-o-plus')
                    ->url(fn (Question $record): string => route('filament.admin.resources.questions.edit', ['record' => $record]))
                    ->openUrlInNewTab(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
