<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Filament\Resources\CourseResource\RelationManagers\ChaptersRelationManager;
use App\Models\Course;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $activeNavigationIcon = 'heroicon-s-book-open';

    protected static ?string $navigationGroup = 'Course Management';

    protected static ?string $recordTitleAttribute = 'course_name';

    public static function getGlobalSearchResultTitle(Model $record): string|Htmlable
    {
        return $record->course_name;
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Course' => $record->course_name,
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
                                Forms\Components\TextInput::make('course_name')
                                    ->required()
                                    ->live(debounce: 500)
                                    ->afterStateUpdated(fn(Set $set, ?string $state) => $set('course_slug', Str::slug($state)))
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('course_slug')
                                    ->readOnly(),
                                Forms\Components\Toggle::make('course_publish')
                                    ->onIcon('heroicon-m-bolt')
                                    ->offIcon('heroicon-m-user')
                                    ->onColor('success')
                                    ->offColor('danger'),
                            ])->columns(2),
                        Tabs\Tab::make('Teachers')
                            ->icon('heroicon-m-user-group')
                            ->schema([
                                Forms\Components\Select::make('teachers')
                                    ->label('Select Teachers')
                                    ->multiple() // untuk memilih lebih dari satu teacher
                                    ->relationship('teachers', 'name') // relasi 'teachers' dengan field 'name'
                                    ->options(User::whereHas('roles', function ($query) {
                                        $query->where('name', 'teacher_user');
                                    })->pluck('name', 'id')) // Mengambil daftar user dengan role 'teacher_user'
                                    ->searchable() // Membuat input dapat dicari
                                    ->preload() // Memuat semua opsi sebelumnya agar cepat
                                    ->required(),
                            ]),
                        Tabs\Tab::make('Image')
                            ->icon('heroicon-m-camera')
                            ->schema([
                                FileUpload::make('course_photo')
                                    ->image()
                                    ->imageEditor()
                                    ->directory('course')
                                    ->optimize('webp')
                                    ->imageEditorEmptyFillColor('#ffffff'),
                            ]),
                        Tabs\Tab::make('Description')
                            ->icon('heroicon-m-chat-bubble-bottom-center-text')
                            ->schema([
                                Forms\Components\RichEditor::make('course_description')
                                    ->required()
                                    ->maxLength(65535)
                                    ->columnSpanFull(),
                            ]),
                    ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('course_photo')
                    ->circular(),
                Tables\Columns\TextColumn::make('course_name')
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('course_publish')
                    ->searchable()
                    ->onIcon('heroicon-m-bolt')
                    ->offIcon('heroicon-m-bolt-slash')
                    ->onColor('success')
                    ->offColor('danger'),
                TextColumn::make('teachers.name')->label('Teachers')->sortable()->badge()->separator(','),
                TextColumn::make('chapters_count')
                    ->counts('chapters')
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
                SelectFilter::make('course_publish')
                    ->searchable()
                    ->preload(),
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
            ChaptersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }
}
