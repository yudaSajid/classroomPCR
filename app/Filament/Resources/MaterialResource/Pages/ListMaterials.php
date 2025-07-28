<?php

namespace App\Filament\Resources\MaterialResource\Pages;

use App\Filament\Resources\MaterialResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListMaterials extends ListRecords
{
    protected static string $resource = MaterialResource::class;

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
            'youtube' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('material_type', 'youtube')),
            'pdf' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('material_type', 'pdf')),
            'text' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('material_type', 'text')),
        ];
    }
}
