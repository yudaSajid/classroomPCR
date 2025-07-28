<?php

namespace App\Filament\Resources\TicketResource\Pages;

use App\Filament\Resources\TicketResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListTickets extends ListRecords
{
    protected static string $resource = TicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'open' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'open'))
                ->badge(fn () => $this->getModel()::where('status', 'open')->count()),

            'in progress' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'in progress'))
                ->badge(fn () => $this->getModel()::where('status', 'in progress')->count()),

            'closed' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'closed'))
                ->badge(fn () => $this->getModel()::where('status', 'closed')->count()),

        ];
    }
}
