<?php

namespace App\Filament\Student\Resources;

use App\Filament\Student\Resources\UserInformationResource\Pages;
use App\Models\UserInformation;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class UserInformationResource extends Resource
{
    protected static ?string $model = UserInformation::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    // protected static ?string $navigationGroup = 'User Management';
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        $userID = Auth::user()->id;

        return $form
            ->schema([
                Section::make()->schema([
                    Forms\Components\TextInput::make('user_id')
                        ->required()
                        ->default($userID)
                        ->readOnly(),
                    Group::make()->schema([

                        Forms\Components\TextInput::make('phone_number')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('gender')
                            ->required()
                            ->options([
                                'Male' => 'Male',
                                'Female' => 'Female,',
                            ]),
                    ])->columns(2),
                    Fieldset::make('Birth Information')->schema([
                        Forms\Components\DatePicker::make('birth_date')
                            ->required()
                            ->label('Date'),
                        Forms\Components\TextInput::make('birth_place')
                            ->required()
                            ->maxLength(255)
                            ->label('Place'),
                    ]),
                    Fieldset::make('Address Information')->schema([
                        Forms\Components\Textarea::make('current_address')
                            ->required()
                            ->maxLength(255)
                            ->label('Current'),
                        Forms\Components\Textarea::make('hometown_address')
                            ->required()
                            ->maxLength(255)
                            ->label('Hometown'),
                    ]),
                    Fieldset::make('Additional Information')->schema([
                        Forms\Components\TextInput::make('province')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('city')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('postal_code')
                            ->required()
                            ->maxLength(255),
                    ])->columns(3),

                ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $userID = Auth::user()->id;
                $query->where('user_id', $userID);
            })
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender')
                    ->searchable(),
                Tables\Columns\TextColumn::make('birth_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('birth_place')
                    ->searchable(),
                Tables\Columns\TextColumn::make('province')
                    ->searchable(),
                Tables\Columns\TextColumn::make('city')
                    ->searchable(),

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
            'index' => Pages\ListUserInformation::route('/'),
            'create' => Pages\CreateUserInformation::route('/create'),
            'edit' => Pages\EditUserInformation::route('/{record}/edit'),
        ];
    }
}
