<?php

namespace App\Filament\Student\Resources\TicketResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class CommentsRelationManager extends RelationManager
{
    protected static string $relationship = 'comments';

    public function form(Form $form): Form
    {
        $userID = Auth::user()->id;

        return $form
            ->schema([
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->default($userID)
                    ->readOnly(),
                Textarea::make('comment')
                    ->required()
                    ->maxLength(255)->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        $userID = Auth::user()->id;

        return $table
            ->recordTitleAttribute('comment')
            ->columns([
                Tables\Columns\TextColumn::make('comment'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->visible(fn ($record) => $record->user_id == $userID),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn ($record) => $record->user_id == $userID),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
