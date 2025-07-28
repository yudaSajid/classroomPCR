<?php

namespace App\Filament\Student\Resources;

use App\Filament\Student\Resources\TicketResource\Pages;
use App\Filament\Student\Resources\TicketResource\RelationManagers\CommentsRelationManager;
use App\Models\Ticket;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    public static function form(Form $form): Form
    {
        $userID = Auth::user()->id;

        return $form
            ->schema([
                Section::make('Ticket Details')->schema([
                    TextInput::make('user_id')
                        ->required()
                        ->default($userID)
                        ->readOnly(),
                    Select::make('title')
                        ->options([
                            'Help' => 'Help',
                            'Report' => 'Report',
                        ])
                        ->required(),
                    TextInput::make('status')
                        ->required()
                        ->default('open')
                        ->readOnly(),
                ])->columns(3),
                Section::make('Ticket Description')->schema([
                    RichEditor::make('description')
                        ->required(),
                ])->columnSpanFull(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->groups([
                'status',
                'title',
            ])
            ->modifyQueryUsing(function (Builder $query) {
                $userID = Auth::user()->id;
                $query->where('user_id', $userID);
            })
            ->defaultGroup('status')
            ->columns([
                TextColumn::make('user.name')
                    ->sortable(),
                TextColumn::make('title')
                    ->sortable(),
                TextColumn::make('status')
                    ->icon(fn (string $state): string => match ($state) {
                        'open' => 'heroicon-o-clipboard-document-list',
                        'in progress' => 'heroicon-o-clock',
                        'closed' => 'heroicon-o-check-circle',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'open' => 'info',
                        'in progress' => 'warning',
                        'closed' => 'success',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('created_at')
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([

                Tables\Actions\EditAction::make()
                    ->visible(fn ($record) => $record->status !== 'closed'),
                Tables\Actions\ViewAction::make(),
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
            CommentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }
}
