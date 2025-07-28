<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketResource\Pages;
use App\Filament\Resources\TicketResource\RelationManagers\CommentsRelationManager;
use App\Models\Ticket;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static ?string $activeNavigationIcon = 'heroicon-s-ticket';

    public static function getNavigationBadge(): ?string
    {
        return Ticket::where('status', 'open')->count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Ticket Details')->schema([
                    Select::make('user_id')
                        ->relationship('user', 'name')
                        ->required(),
                    Select::make('title')
                        ->options([
                            'Help' => 'Help',
                            'Report' => 'Report',
                        ])
                        ->required(),
                    Select::make('status')
                        ->options([
                            'open' => 'Open',
                            'in progress' => 'in progress',
                            'closed' => 'Closed',
                        ])
                        ->required()
                        ->default('open'),
                ])->columns(3),
                Section::make('Ticket Description')->schema([
                    RichEditor::make('description')
                        ->required()
                        ->hiddenLabel()
                        ->placeholder('Please describe your ticket description'),
                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->groups([
                'status',
                'user.name',
            ])
            ->defaultGroup('status')
            ->columns([
                TextColumn::make('user.name')
                    ->sortable(),
                TextColumn::make('title')
                    ->sortable(),
                SelectColumn::make('status')
                    ->options([
                        'open' => 'Open',
                        'in progress' => 'In Progress',
                        'closed' => 'Closed',
                    ])

                    ->sortable(),

                TextColumn::make('created_at')
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
