<?php

namespace App\Filament\Teacher\Resources;

use App\Filament\Teacher\Resources\QuizResource\Pages;
use App\Filament\Teacher\Resources\QuizResource\RelationManagers;
use App\Filament\Teacher\Resources\QuizResource\RelationManagers\QuestionsRelationManager;
use App\Models\Quiz;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuizResource extends Resource
{
    protected static ?string $model = Quiz::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Management';
    protected static ?string $navigationParentItem = 'Course';
    protected static bool $shouldRegisterNavigation = true;
    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Quiz Details')
                ->schema([
                    Forms\Components\Select::make('course_id')
                        ->relationship('course', 'course_name')
                        ->required()
                        ->live()
                        ->searchable(),
                    Forms\Components\Select::make('chapter_id')
                        ->relationship('chapter', 'titles')
                        ->required()
                        ->searchable()
                        ->options(function (Forms\Get $get) {
                            $courseId = $get('course_id');
                            if (!$courseId) return [];
                            return \App\Models\Chapter::where('course_id', $courseId)
                                ->pluck('titles', 'id');
                        }),
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\RichEditor::make('description')
                        ->columnSpanFull(),
                ])->columns(2)
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('course.course_name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('chapter.titles')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('questions_count')
                    ->counts('questions')
                    ->badge(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\SelectFilter::make('course')
                    ->relationship('course', 'course_name'),
                Tables\Filters\SelectFilter::make('chapter')
                    ->relationship('chapter', 'titles'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            QuestionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuizzes::route('/'),
            'create' => Pages\CreateQuiz::route('/create'),
            'edit' => Pages\EditQuiz::route('/{record}/edit'),
            'view' => Pages\ViewQuizzes::route('/{record}'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
