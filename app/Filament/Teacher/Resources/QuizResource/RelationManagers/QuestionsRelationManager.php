<?php

namespace App\Filament\Teacher\Resources\QuizResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuestionsRelationManager extends RelationManager
{
    protected static string $relationship = 'questions';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Question')
                ->schema([
                    Forms\Components\TextInput::make('question_text')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\FileUpload::make('question_image')
                        ->image()
                        ->optimize('webp')
                        ->imageEditor()
                        ->directory('question')
                        ->imageEditorEmptyFillColor('#ffffff'),
                    Forms\Components\Repeater::make('answers')
                        ->relationship()
                        ->schema([
                            Forms\Components\TextInput::make('text')
                                ->required(),
                            Forms\Components\Toggle::make('is_correct')
                                ->required(),
                            Forms\Components\Textarea::make('reasons')
                                ->label('Explanation (shown when answer is selected)')
                        ])
                        ->columns(1)
                        ->minItems(2)
                        ->maxItems(5)
                        ->columnSpanFull(),
                ])->columns(1)
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('question_text')
                    ->limit(50),
                Tables\Columns\ImageColumn::make('question_image'),
                Tables\Columns\TextColumn::make('answers_count')
                    ->counts('answers')
                    ->label('Answers'),
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
