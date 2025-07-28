<?php

namespace App\Filament\Student\Pages;

use Filament\Pages\Page;

class UserInfo extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.student.pages.user-info';

    protected static ?string $navigationGroup = 'User Management';

    public static ?string $navigationLabel = 'Informations';

    public $activeTab = 'tab1';
}
