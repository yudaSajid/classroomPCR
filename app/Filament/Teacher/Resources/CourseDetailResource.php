<?php

namespace App\Filament\Teacher\Resources;

use App\Filament\Resources\CourseResource\RelationManagers\ChaptersRelationManager;
use App\Filament\Teacher\Resources\CourseDetailResource\Pages;
use App\Filament\Teacher\Resources\CourseDetailResource\RelationManagers;
use App\Livewire\CourseChapterList;
use App\Livewire\CourseTeacherJoin;
use App\Models\Course;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Livewire;
use Filament\Infolists\Components\Tabs as InfoTabs;


class CourseDetailResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static bool $shouldRegisterNavigation = false;
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
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
 
public static function infolist(Infolist $infolist): Infolist
{
    return $infolist
        ->schema([
            InfoTabs::make('Tabs')
                ->tabs([
                    InfoTabs\Tab::make('Identity')
                        ->icon('heroicon-m-bell')
                        ->schema([
                            Section::make('Course Information')
                                ->schema([
                                    TextEntry::make('course_name')
                                        ->label('Course Title')
                                        ->weight('bold'),
                                    
                                    TextEntry::make('course_publish')
                                        ->label('Status')
                                        ->badge()
                                        ->color(fn (string $state): string => match ($state) {
                                            '1' => 'success',
                                            '0' => 'danger',
                                        })
                                        ->formatStateUsing(fn (string $state): string => match ($state) {
                                            '1' => 'Published',
                                            '0' => 'Draft',
                                        }),

                                    Section::make('Teaching Staff')
                                        ->schema([
                                            TextEntry::make('teachers.name')
                                                ->label('Assigned Teachers')
                                                ->badge()
                                                ->color('info'),
                                                
                                            Livewire::make(CourseTeacherJoin::class, 
                                                fn ($record) => ['course' => $record->id])
                                                ->lazy(),
                                        ])
                                ])
                                ->columns(2)
                        ])->columns(1),
          
                    InfoTabs\Tab::make('Details')
                        ->icon('heroicon-m-cursor-arrow-ripple')
                        ->schema([
                            Livewire::make(CourseChapterList::class, 
                            fn ($record) => ['course' => $record->id])
                            ->lazy(),
                        ]),
                    InfoTabs\Tab::make('Description')
                        ->icon('heroicon-m-chat-bubble-bottom-center-text')
                        ->schema([
                            ImageEntry::make('course_photo')
                            ->disk('public')
                            ->width(400)
                            ->height(300),
                            TextEntry::make('course_description')
                                ->markdown()
                                ->columnSpanFull(),
                        ]),
                ])->columnSpanFull(),
        ]);
}

    public static function getRelations(): array
    {
        return [
            // ChaptersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourseDetails::route('/'),
            'create' => Pages\CreateCourseDetail::route('/create'),
            'view' => Pages\ViewCourseDetail::route('/{record}'),
            'edit' => Pages\EditCourseDetail::route('/{record}/edit'),
        ];
    }
}
