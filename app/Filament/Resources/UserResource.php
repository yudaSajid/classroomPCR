<?php

namespace App\Filament\Resources;

// use App\Filament\Actions\ImportStudentsAction;

use App\Filament\Imports\StudentImporter;
use App\Filament\Resources\UserResource\Pages;
// use App\Imports\UsersImport;
use App\Livewire\Users\Completion;
use App\Models\Image;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Infolists\Components\Livewire;
use Filament\Infolists\Components\Tabs;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Notifications\Notification;
use EightyNine\ExcelImport\ExcelImportAction;
use App\Imports\StudentImport;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'User Management';

    protected static ?string $recordTitleAttribute = 'name';

    public static function getGlobalSearchResultTitle(Model $record): string|Htmlable
    {
        return $record->name;
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Email' => $record->email,
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('password')
                        ->password()
                        ->required()
                        ->dehydrateStateUsing(fn($state) => Hash::make($state))
                        ->dehydrated(fn($state) => filled($state))
                        ->required(fn(string $context): bool => $context === 'create')
                        ->maxLength(255),
                    Select::make('avatar')
                        ->label('Choose Avatar')
                        ->options(
                            Image::where('type', 'profile')->get()->mapWithKeys(function ($image) {
                                // Mengembalikan opsi dengan HTML gambar di dalam label
                                return [
                                    $image->path => '<img src="' . asset('storage/' . $image->path) . '" style="width: 50px; height: 50px; object-fit: cover;">',
                                ];
                            })->toArray()
                        )
                        ->allowHtml()
                        ->searchable() // Tambahkan jika Anda ingin opsi dapat dicari
                        ->reactive() // Jika ingin select bereaksi terhadap perubahan lain
                    ,
                ])->columnSpan(3),
                Group::make([
                    Section::make([
                        Forms\Components\DateTimePicker::make('email_verified_at'),
                    ]),
                    Section::make([
                        Forms\Components\Select::make('roles')
                            ->relationship('roles', 'name')
                            ->multiple()
                            ->preload()
                            ->searchable(),
                    ]),
                ])->columnSpan(1),

            ])->columns(4);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                ImportAction::make('import_students')
                    ->label('Import Students')
                    ->form([
                        Forms\Components\FileUpload::make('file')
                            ->label('Excel File')
                            ->acceptedFileTypes([
                                'application/vnd.ms-excel',
                                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                            ])
                            ->directory('imports')
                            ->preserveFilenames()
                            ->required()
                    ])
                    ->action(function (array $data): void {
                        $filePath = storage_path('app/public/' . $data['file']);
                        Excel::import(new StudentImport, $filePath);

                        Notification::make()
                            ->title('Import completed successfully')
                            ->success()
                            ->send();
                    })
            ])
            ->columns([
                Tables\Columns\TextColumn::make('roles.name')
                    ->label('Roles')

                    ->formatStateUsing(fn($state) => collect($state)->map(function ($role) {
                        // Adjust the role name
                        $rolesMap = [
                            'super_admin' => 'Super Admin',
                            'teacher_user' => 'Teacher',
                            'student_user' => 'Student',
                        ];

                        return $rolesMap[$role] ?? $role;
                    })->join(', '))
                    ->badge()
                    ->colors([
                        'primary',
                        'success' => 'teacher_user',
                        'danger' => 'super_admin',
                    ]),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Email address copied')
                    ->copyMessageDuration(1500),
                Tables\Columns\TextColumn::make('classrooms.class_name')
                    ->badge(),
                ImageColumn::make('avatar')->circular(),
                Tables\Columns\TextColumn::make('email_verified_at')
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
                SelectFilter::make('Classroom')
                    ->relationship('classrooms', 'class_name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('Role')
                    ->relationship('roles', 'name')
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                ActionGroup::make([
                    EditAction::make(),
                    ViewAction::make(),

                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])

            ->modifyQueryUsing(function (Builder $query) {
                if (Auth::check() && Auth::user()->roles->contains('name', 'teacher_user')) {
                    $query->whereDoesntHave('roles', fn($query) => $query->where('name', 'super_admin'));
                }
            });
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('Total Points')
                            ->schema([
                                // ...
                            ]),
                        Tabs\Tab::make('Course')
                            ->schema([
                                Livewire::make(Completion::class, fn($record) => ['userId' => $record->id])->lazy(),
                            ]),
                        Tabs\Tab::make('Badges')
                            ->schema([
                                // ...
                            ]),
                    ])->columnSpanFull(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
