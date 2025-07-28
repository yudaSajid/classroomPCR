<?php

namespace App\Filament\Resources\ClassroomResource\RelationManagers;

use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class UsersRelationManager extends RelationManager
{
    protected static string $relationship = 'users';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name') // Ensure 'user' is the correct relationship name in the model
                    ->options(function () {
                        $classroom = $this->getRelationship()->getParent();
                        if (! $classroom) {
                            return [];
                        }
                        // Get IDs of users already attached to the classroom
                        $attachedUserIds = $classroom->users->pluck('user_id')->toArray();

                        return User::whereHas('userEducation', function ($query) use ($classroom) {
                            $query->where('enrollment_year', $classroom->enrollment_year)
                                ->where('class_alphabet', $classroom->class_alphabet)
                                ->where('program_id', $classroom->program_id);
                        })
                            ->whereNotIn('id', $attachedUserIds)
                            ->pluck('name', 'id');
                    })
                    ->searchable()
                    ->required(),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('userEducation.program.program_name')
                    ->label('Program'),
            ])
            ->filters([
                // Add any filters if needed
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->form(function () {
                        $classroom = $this->getRelationship()->getParent();

                        if (! $classroom) {
                            return [];
                        }

                        return [
                            Forms\Components\Select::make('user_id')
                                ->label('User')
                                ->relationship('user', 'name')
                                ->options(function () {
                                    $classroom = $this->getRelationship()->getParent();
                                    if (! $classroom) {
                                        return [];
                                    }
                                    // Get IDs of users already attached to the classroom
                                    $attachedUserIds = $classroom->users->pluck('id')->toArray();
                                    $options = User::whereHas('userEducation', function ($query) use ($classroom) {
                                        $query->where('enrollment_year', $classroom->enrollment_year)
                                            ->where('class_alphabet', $classroom->class_alphabet)
                                            ->where('program_id', $classroom->program_id);
                                    })
                                        ->whereNotIn('id', $attachedUserIds)
                                        ->pluck('name', 'id')
                                        ->toArray();

                                    return ['all' => 'Select All'] + $options;
                                })
                                ->searchable()
                                ->required(),
                        ];
                    })
                    ->action(fn ($data) => $this->handleAttachAction($data)),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    protected function handleAttachAction($data)
    {
        $classroom = $this->getRelationship()->getParent();

        if ($classroom && isset($data['user_id'])) {
            if ($data['user_id'] === 'all') {
                // Get IDs of users already attached to the classroom
                $attachedUserIds = $classroom->users()->pluck('users.id')->toArray();

                // Attach only users who are not already attached
                $usersToAttach = User::whereHas('userEducation', function ($query) use ($classroom) {
                    $query->where('class_alphabet', $classroom->class_alphabet)
                        ->where('enrollment_year', $classroom->enrollment_year)
                        ->where('program_id', $classroom->program_id);
                })
                    ->whereNotIn('id', $attachedUserIds)
                    ->pluck('id')
                    ->toArray();

                $classroom->users()->attach($usersToAttach);
            } else {
                // Attach the selected user to the classroom
                $classroom->users()->attach($data['user_id']);
            }
        }
    }
}
