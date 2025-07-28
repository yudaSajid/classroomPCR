<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChallengeResource\Pages;
use App\Filament\Resources\ChallengeResource\RelationManagers\TasksRelationManager;
use App\Models\Challenge;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ChallengeResource extends Resource
{
    protected static ?string $model = Challenge::class;

    protected static ?string $navigationIcon = 'heroicon-o-code-bracket-square';

    protected static ?string $activeNavigationIcon = 'heroicon-s-code-bracket-square';

    protected static ?string $navigationGroup = 'Course Management';

    protected static ?string $recordTitleAttribute = 'challenge_name';

    public static function getGlobalSearchResultTitle(Model $record): string|Htmlable
    {
        return $record->challenge_name;
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Challenge' => $record->challenge_name,
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('Identity')
                            ->icon('heroicon-m-bell')
                            ->schema([
                                Forms\Components\Select::make('course_id')
                                    ->required()
                                    ->relationship('course', 'course_name'),
                                Forms\Components\TextInput::make('challenge_name')
                                    ->required()
                                    ->live(debounce: 500)
                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('challenge_slug', Str::slug($state)))
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('challenge_slug')
                                    ->readOnly(),
                                Forms\Components\Toggle::make('challenge_publish')
                                    ->onIcon('heroicon-m-bolt')
                                    ->offIcon('heroicon-m-user')
                                    ->onColor('success')
                                    ->offColor('danger'),
                            ])->columns(2),
                        Tabs\Tab::make('Description')
                            ->icon('heroicon-m-chat-bubble-bottom-center-text')
                            ->schema([
                                Forms\Components\RichEditor::make('challenge_description')
                                    ->required()
                                    ->maxLength(65535)
                                    ->columnSpanFull(),
                            ]),
                        Tabs\Tab::make('Image')
                            ->icon('heroicon-m-camera')
                            ->schema([
                                FileUpload::make('challenge_photo')
                                    ->image()
                                    ->imageEditor()
                                    ->optimize('webp')
                                    ->directory('challenge')
                                    ->imageEditorEmptyFillColor('#ffffff'),
                            ]),
                    ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->groups([
                'course.course_name',
            ])
            ->columns([
                Tables\Columns\ImageColumn::make('challenge_photo')
                    ->circular(),
                Tables\Columns\TextColumn::make('course.course_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('challenge_name')
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('challenge_publish')
                    ->searchable()
                    ->onIcon('heroicon-m-bolt')
                    ->offIcon('heroicon-m-bolt-slash')
                    ->onColor('success')
                    ->offColor('danger')
                    ->alignCenter(),
                TextColumn::make('tasks.task_name')
                    ->badge()
                    ->separator(',')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->slideOver(),
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
            TasksRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListChallenges::route('/'),
            'create' => Pages\CreateChallenge::route('/create'),
            'edit' => Pages\EditChallenge::route('/{record}/edit'),
        ];
    }
}
