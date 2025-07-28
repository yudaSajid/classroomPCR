<?php

namespace App\Filament\Resources\ImageResource\Pages;

use App\Enums\ImageType;
use App\Filament\Resources\ImageResource;
use App\Models\Image;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListImages extends ListRecords
{
    protected static string $resource = ImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $tabs = [];

        // Tab untuk semua gambar
        $tabs[] = Tab::make('All Images')
            ->badge(Image::count())
            ->modifyQueryUsing(fn ($query) => $query); // Tidak memodifikasi query

        // Tabs untuk setiap tipe gambar
        foreach (ImageType::toSelectArray() as $key => $label) {
            $tabs[] = Tab::make($label)
                ->badge(Image::where('type', $key)->count())
                ->modifyQueryUsing(fn ($query) => $query->where('type', $key)); // Filter berdasarkan tipe gambar
        }

        return $tabs;
    }
}
