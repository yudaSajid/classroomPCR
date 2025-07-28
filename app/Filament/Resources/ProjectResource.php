<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationGroup = 'Course Management';

    protected static ?string $navigationParentItem = 'Courses';

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
                                Forms\Components\TextInput::make('project_name')
                                    ->required()
                                    ->live(debounce: 500)
                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('project_slug', Str::slug($state)))
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('project_slug')
                                    ->readOnly(),
                                // TextInput::make("project_name")
                                // ->numeric(),
                                Forms\Components\Toggle::make('project_publish')
                                    ->onIcon('heroicon-m-bolt')
                                    ->offIcon('heroicon-m-user')
                                    ->onColor('success')
                                    ->offColor('danger'),
                            ])->columns(2),
                        Tabs\Tab::make('Description')
                            ->icon('heroicon-m-chat-bubble-bottom-center-text')
                            ->schema([
                                Forms\Components\RichEditor::make('project_description')
                                    ->required()
                                    ->maxLength(65535)
                                    ->columnSpanFull(),
                            ]),
                        Tabs\Tab::make('Image')
                            ->icon('heroicon-m-camera')
                            ->schema([
                                FileUpload::make('project_photo')
                                    ->image()
                                    ->imageEditor()
                                    ->directory('projects')
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
                Tables\Columns\ImageColumn::make('project_photo')
                    ->circular(),
                Tables\Columns\TextColumn::make('course.course_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('project_name')
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('project_publish')
                    ->searchable()
                    ->onIcon('heroicon-m-bolt')
                    ->offIcon('heroicon-m-bolt-slash')
                    ->onColor('success')
                    ->offColor('danger'),
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
            'index' => Pages\ListProjects::route('/'),
            // 'create' => Pages\CreateProject::route('/create'),
            // 'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
