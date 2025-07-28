<?php

namespace Tests\Unit\Filament\Student\Pages;

use App\Filament\Student\Pages\Classroom;
use PHPUnit\Framework\TestCase;

class ClassroomTest extends TestCase
{
    /** @test */
    public function it_has_the_correct_navigation_icon()
    {
        $this->assertEquals('heroicon-o-academic-cap', Classroom::getNavigationIcon());
    }

    /** @test */
    public function it_has_the_correct_active_navigation_icon()
    {
        $this->assertEquals('heroicon-s-academic-cap', Classroom::getActiveNavigationIcon());
    }

    /** @test */
    public function it_has_the_correct_navigation_group()
    {
        $this->assertEquals('Courses', Classroom::getNavigationGroup());
    }

    /** @test */
    public function it_has_the_correct_navigation_label()
    {
        $this->assertEquals('Courses', Classroom::getNavigationLabel());
    }

    /** @test */
    public function it_has_the_correct_view()
    {
        $this->assertEquals('filament.student.pages.classroom', (new Classroom())->getView());
    }

    /** @test */
    public function it_has_an_empty_heading()
    {
        $this->assertEquals('', (new Classroom())->getHeading());
    }
}