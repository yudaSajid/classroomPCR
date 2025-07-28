<?php

namespace App\Filament\Widgets;

use App\Models\UserEducation;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $tiCount = UserEducation::whereHas('program', function ($query) {
            $query->where('program_name', 'Teknik Informatika');
        })->count();

        return [
            Stat::make('Teknik Informatika Users', $tiCount)
                ->description('Total users in Teknik Informatika program')
                ->descriptionIcon('heroicon-s-user-group'),
        ];
    }
}
