<?php

namespace Tests\Unit\Filament\Student\Pages;

use App\Filament\Student\Pages\SkillBadgePage;
use App\Models\Point;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\TestCase;

class SkillBadgePageTest extends TestCase
{
    /** @test */
    public function it_has_the_correct_navigation_icon()
    {
        $this->assertEquals('heroicon-o-check-badge', SkillBadgePage::getNavigationIcon());
    }

    /** @test */
    public function it_has_the_correct_view()
    {
        $this->assertEquals('filament.student.pages.skill-badge-page', (new SkillBadgePage())->getView());
    }

    // /** @test */
    // public function it_returns_the_correct_user_points()
    // {
    //     // Mock the Auth facade
    //     Auth::shouldReceive('id')
    //         ->once()
    //         ->andReturn(1);

    //     // Mock the Point model
    //     $pointMock = $this->createMock(Point::class);
    //     $pointMock->expects($this->once())
    //               ->method('where')
    //               ->with('user_id', 1)
    //               ->willReturn($pointMock);
    //     $pointMock->expects($this->once())
    //               ->method('sum')
    //               ->with('points')
    //               ->willReturn(100);

    //     // Replace the original Point model with the mock for this test
    //     Point::setInstance($pointMock);

    //     $page = new SkillBadgePage();
    //     $this->assertEquals(100, $page->getUserPoints());
    // }
}