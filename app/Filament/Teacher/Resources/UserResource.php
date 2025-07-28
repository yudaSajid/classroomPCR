<?php

namespace App\Filament\Teacher\Resources;

use App\Filament\Teacher\Resources\UserResource\Pages;
use App\Models\Image;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static bool $shouldRegisterNavigation = false;

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
                        ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                        ->dehydrated(fn ($state) => filled($state))
                        ->required(fn (string $context): bool => $context === 'create')
                        ->maxLength(255),
                    Select::make('avatar')
                        ->label('Choose Avatar')
                        ->options(
                            Image::where('type', 'profile')->get()->mapWithKeys(function ($image) {
                                // Mengembalikan opsi dengan HTML gambar di dalam label
                                return [
                                    $image->path => '<img src="'.asset('storage/'.$image->path).'" style="width: 50px; height: 50px; object-fit: cover;">',
                                ];
                            })->toArray()
                        )
                        ->allowHtml()
                        ->searchable() // Tambahkan jika Anda ingin opsi dapat dicari
                        ->required()
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
            ->groups([
                'roles.name',
                'classrooms.class_name',
            ])
            ->columns([
                Tables\Columns\TextColumn::make('roles.name')
                    ->label('Roles')
                    ->sortable()
                    ->searchable()

                    ->formatStateUsing(fn ($state) => collect($state)->map(function ($role) {
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
                    ->searchable(),
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
                    $query->whereDoesntHave('roles', fn ($query) => $query->where('name', 'super_admin'));
                }
            });
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
