<?php

namespace App\Providers\Filament;

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
use App\Filament\Pages\Auth\Register;
use Illuminate\Support\Facades\Blade;

class StudentPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('student')
            ->path('student')
            ->maxContentWidth(MaxWidth::Full)
            ->sidebarCollapsibleOnDesktop()
            ->registration(Register::class)
            ->profile()
            ->colors([
                'danger' => Color::Rose,
                'gray' => Color::Gray,
                'info' => Color::Blue,
                'primary' => '#a21caf',
                'success' => Color::Emerald,
                'warning' => Color::Orange,
            ])
            ->brandLogo(asset('storage/assets/logo_elearning.png'))
            ->brandLogoHeight('3rem')
            // ->topNavigation()
            ->discoverResources(in: app_path('Filament/Student/Resources'), for: 'App\\Filament\\Student\\Resources')
            ->discoverPages(in: app_path('Filament/Student/Pages'), for: 'App\\Filament\\Student\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Student/Widgets'), for: 'App\\Filament\\Student\\Widgets')
            ->widgets([])
            ->discoverClusters(in: app_path('Filament/Student/Clusters'), for: 'App\\Filament\\Clusters\\Student')
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
                'throttle:filament-login',
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugins([
                \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make(),
            ])
            ->login()
            ->viteTheme(['resources/css/filament/student/theme.css', 'resources/js/countdown-timer.js'])
            ->spa()
            ->renderHook(
                'panels::body.end',
                fn () => Blade::render(<<<'BLADE'
                    <script>
                        document.addEventListener('alpine:init', () => {
                            const setStudentSidebarState = () => {
                                const path = window.location.pathname;
                                const isStudentCoursePage = path.startsWith('/student/course-details/');

                                const currentWidth = window.innerWidth;
                                const isDesktopOrLarger = currentWidth >= 1024;

                                if (window.Alpine && window.Alpine.store('sidebar')) {
                                    if (isDesktopOrLarger) {
                                        if (isStudentCoursePage) {
                                            window.Alpine.store('sidebar').close();
                                            console.log('Sidebar: CLOSED (Course page on Desktop/Laptop)');
                                        } else {
                                            window.Alpine.store('sidebar').open();
                                            console.log('Sidebar: OPEN (Non-course page on Desktop/Laptop)');
                                        }
                                    } else {
                                        window.Alpine.store('sidebar').close();
                                        console.log('Sidebar: CLOSED (Mobile/Tablet)');
                                    }
                                } else {
                                    console.warn('Alpine or Filament sidebar store not ready yet!');
                                }
                            };

                            setStudentSidebarState();
                            document.addEventListener('livewire:navigated', setStudentSidebarState);
                            window.addEventListener('resize', setStudentSidebarState);
                        });

                        // --- START: Livewire Listeners untuk quiz dari MaterialInfo ---
                        document.addEventListener('livewire:initialized', () => {
                            // Listener untuk event dari TakeQuiz component
                            Livewire.on('quizCompleted', (event) => {
                                // Panggil loadContent di MaterialInfo untuk re-calculate attempts
                                Livewire.getByName('courses.material-info').forEach(component => {
                                     component.call('loadContent', null, event.detail.quizId, null, event.detail.isPassed); // Teruskan isPassed
                                });
                            });

                            Livewire.on('quizRetakeStarted', (event) => {
                                Livewire.getByName('courses.material-info').forEach(component => {
                                    component.call('loadContent', null, event.detail.quizId, null);
                                });
                            });
                        });
                        // --- END: Livewire Listeners ---

                    </script>
                BLADE)
            );
    }
}