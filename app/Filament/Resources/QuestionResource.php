<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuestionResource\Pages;
use App\Models\Question;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    // protected static ?string $navigationGroup = 'Quiz Management';
    // protected static ?string $navigationParentItem = 'Quizzes';

    // protected static ?int $navigationSort = 2;
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Question of things')->schema([
                    Forms\Components\Select::make('quiz_id')
                        ->required()
                        ->relationship('quiz', 'title'),
                    Forms\Components\Textarea::make('question_text')
                        ->required()
                        ->maxLength(65535),
                ])->columnSpan(2),
                Section::make('Image')->schema([
                    Forms\Components\FileUpload::make('question_image')
                        ->image()
                        ->optimize('webp')
                        ->imageEditor()
                        ->directory('question')
                        ->imageEditorEmptyFillColor('#ffffff'),
                ])->collapsible()->collapsed()->columnSpan(1),
                Section::make('Answers')->schema([
                    Repeater::make('answers')
                        ->relationship('answers')
                        ->reorderable()
                        ->cloneable()
                        ->collapsible()
                        ->hiddenLabel()
                        ->addActionLabel('Add Answer')
                        ->schema([
                            Forms\Components\Toggle::make('is_correct')
                                ->required(),
                            Section::make('')->schema([

                                Forms\Components\Textarea::make('text')
                                    ->required()
                                    ->maxLength(65535)
                                    ->live(onBlur: true),
                                Forms\Components\Textarea::make('reasons')
                                    ->label('Reason')
                                    ->helperText('optional')
                                    ->maxLength(65535)
                                    ->helperText('Fill in if answer is correct'),
                            ])->columns(2),

                        ])
                        ->itemLabel(fn (array $state): ?string => $state['text'] ?? null),
                ]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->groups([
                'quiz.title',
            ])
            ->defaultGroup('quiz.title')
            ->columns([
                Tables\Columns\TextColumn::make('quiz.title')
                    ->sortable(),
                Tables\Columns\TextColumn::make('question_text')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('answers_count')
                    ->counts('answers')
                    ->alignCenter(),
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
            'index' => Pages\ListQuestions::route('/'),
            'create' => Pages\CreateQuestion::route('/create'),
            'edit' => Pages\EditQuestion::route('/{record}/edit'),
        ];
    }
}
