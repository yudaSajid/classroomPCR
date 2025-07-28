<?php

namespace App\Filament\Teacher\Resources\ChapterResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class QuizzesRelationManager extends RelationManager
{
    protected static string $relationship = 'quizzes';
    protected static ?string $title = 'Chapter Quizzes';
    protected static ?string $recordTitleAttribute = 'title';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('course_id')
                    ->default(fn($record) => $record?->course_id ?? $this->getOwnerRecord()->course_id),
                Forms\Components\Hidden::make('chapter_id')
                    ->default(fn() => $this->getOwnerRecord()->id),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\RichEditor::make('description')
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->description(fn($record) => \Illuminate\Support\Str::limit($record->description, 50)),
                Tables\Columns\TextColumn::make('questions_count')
                    ->counts('questions')
                    ->label('Questions')
                    ->badge(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make('manage_questions')
                    ->label('Manage Questions')
                    ->icon('heroicon-o-question-mark-circle')
                    ->url(fn($record) => route('filament.teacher.resources.quizzes.edit', ['record' => $record->id]))
                    ->color('success'),
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
