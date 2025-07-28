<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuizResource\Pages;
use App\Filament\Resources\QuizResource\RelationManagers\QuestionsRelationManager;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Quiz;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class QuizResource extends Resource
{
    protected static ?string $model = Quiz::class;

    protected static ?string $navigationIcon = 'heroicon-o-puzzle-piece';

    protected static ?string $activeNavigationIcon = 'heroicon-s-puzzle-piece';

    protected static ?string $navigationGroup = 'Course Management';

    protected static ?string $navigationParentItem = 'Courses';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Choose Chapter')
                        ->schema([
                            Select::make('course_id')
                                ->relationship('course', 'course_name')
                                ->required()
                                ->reactive()
                                ->afterStateUpdated(function (callable $set) {
                                    $set('chapter_id', null); // Reset chapter_id when course_id changes
                                }),

                            Select::make('chapter_id')
                                ->required()
                                ->options(function (callable $get) {
                                    $courseId = $get('course_id');

                                    if ($courseId) {
                                        // Retrieve chapters related to the selected course
                                        return Chapter::where('course_id', $courseId)->pluck('titles', 'id');
                                    }

                                    return [];
                                }),
                                Forms\Components\TextInput::make('title')
                                ->required()
                                ->maxLength(255),
                        ]),
                    // Wizard\Step::make('Details')
                    //     ->schema([
                    //         Forms\Components\TextInput::make('title')
                    //             ->required()
                    //             ->maxLength(255),
                    //         Forms\Components\RichEditor::make('description')
                    //             ->columnSpanFull(),
                    //     ]),
                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('chapter.titles')
                    ->searchable()
                    ->label('Chapter'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('questions_count')
                    ->counts('questions')
                    ->alignCenter(),
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
            QuestionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuizzes::route('/'),
            'create' => Pages\CreateQuiz::route('/create'),
            'edit' => Pages\EditQuiz::route('/{record}/edit'),
        ];
    }
}
