<?php

namespace Tests\Unit\Filament\Teacher\Pages;

use App\Filament\Teacher\Pages\BadgePage;
use PHPUnit\Framework\TestCase;

class BadgePageTest extends TestCase
{
    /** @test */
    public function it_has_the_correct_navigation_icon()
    {
        $this->assertEquals('heroicon-o-check-badge', BadgePage::getNavigationIcon());
    }

    /** @test */
    public function it_has_the_correct_navigation_label()
    {
        $this->assertEquals('Badge', BadgePage::getNavigationLabel());
    }

    /** @test */
    public function it_has_the_correct_navigation_group()
    {
        $this->assertEquals('Management', BadgePage::getNavigationGroup());
    }

    /** @test */
    public function it_has_the_correct_heading()
    {
        $this->assertEquals('Badge', (new BadgePage())->getHeading());
    }

    /** @test */
    public function it_has_the_correct_view()
    {
        $this->assertEquals('filament.teacher.pages.badge-page', (new BadgePage())->getView());
    }
}