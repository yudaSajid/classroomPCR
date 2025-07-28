<?php

namespace App\Filament\Resources\ClassroomUserResource\Pages;

use App\Filament\Resources\ClassroomUserResource;
use App\Filament\Resources\ClassroomResource;
use Filament\Resources\Pages\CreateRecord;

class CreateClassroomUser extends CreateRecord
{
    protected static string $resource = ClassroomResource::class;
}
