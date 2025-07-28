<?php

namespace App\Filament\Clusters\Grades\Resources\UserAssignmentStatusResource\Pages;

use App\Enums\Status;
use App\Filament\Clusters\Grades\Resources\UserAssignmentStatusResource;
use App\Models\UserAssignmentStatus;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListUserAssignmentStatuses extends ListRecords
{
    protected static string $resource = UserAssignmentStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Tasks')
                ->badge(UserAssignmentStatus::count()), // Total semua tugas
            'pending' => Tab::make('Pending')
                ->badge(UserAssignmentStatus::where('status', Status::Pending)->count()) // Hitung Pending
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', Status::Pending)),
            'approved' => Tab::make('Approved')
                ->badge(UserAssignmentStatus::where('status', Status::Approved)->count()) // Hitung Approved
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', Status::Approved)),
            'rejected' => Tab::make('Rejected')
                ->badge(UserAssignmentStatus::where('status', Status::Reject)->count()) // Hitung Rejected
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', Status::Reject)),
        ];
    }

    public function getDefaultActiveTab(): string|int|null
    {
        return 'pending';
    }
}
