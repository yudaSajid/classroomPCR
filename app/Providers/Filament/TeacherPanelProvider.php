<?php

namespace App\Providers\Filament;

use App\Filament\Teacher\Pages\ClassroomPage;
use App\Filament\Teacher\Pages\CoursePage;
use App\Filament\Teacher\Pages\BadgePage;
use App\Filament\Teacher\Resources\ClassroomDetailResource;
use App\Filament\Widgets\StatsOverview;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Support\Enums\MaxWidth;
use App\Filament\Teacher\Resources\ProjectSubmissionResource;

class TeacherPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('teacher')
            ->path('teacher')
            ->colors([
                'primary' => Color::Rose,
            ])
            ->brandLogo(asset('storage/assets/logo_elearning.png'))
            ->brandLogoHeight('3rem')
            ->profile()
            ->registration()
            ->maxContentWidth(MaxWidth::Full)
            ->globalSearchKeyBindings(['command+k', 'ctrl+k'])
            ->sidebarCollapsibleOnDesktop()
            ->resources([
                ProjectSubmissionResource::class,
            ])
            ->discoverResources(in: app_path('Filament/Teacher/Resources'), for: 'App\\Filament\\Teacher\\Resources')
            ->discoverPages(in: app_path('Filament/Teacher/Pages'), for: 'App\\Filament\\Teacher\\\Pages')
            ->discoverClusters(in: app_path('Filament/Teacher/Clusters'), for: 'App\\Filament\\Teacher\\Clusters')
            ->pages([
                \App\Filament\Teacher\Pages\TeacherDashboard::class,
                ClassroomPage::class,
                CoursePage::class,
                BadgePage::class,
                // ClassroomDetailResource::class,
            ])
            ->homeUrl(fn (): string => \App\Filament\Teacher\Pages\TeacherDashboard::getUrl())
            ->discoverWidgets(in: app_path('Filament/Teacher/Widgets'), for: 'App\\Filament\\Teacher\\Widgets')
            ->widgets([
                StatsOverview::class,

            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugins([
                // \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make(),
            ])

            ->login()
            ->viteTheme('resources/css/filament/student/theme.css')
            ->spa();
    }
}
