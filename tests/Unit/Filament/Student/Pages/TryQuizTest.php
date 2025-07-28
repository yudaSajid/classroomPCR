<?php

namespace Tests\Unit\Filament\Student\Pages;

use App\Filament\Student\Pages\TryQuiz;
use PHPUnit\Framework\TestCase;

class TryQuizTest extends TestCase
{
    /** @test */
    public function it_has_the_correct_navigation_icon()
    {
        $this->assertEquals('heroicon-o-document-text', TryQuiz::getNavigationIcon());
    }

    /** @test */
    public function it_has_the_correct_view()
    {
        $this->assertEquals('filament.student.pages.try-quiz', (new TryQuiz())->getView());
    }

    /** @test */
    public function it_should_not_register_navigation()
    {
        $this->assertFalse(TryQuiz::shouldRegisterNavigation());
    }
}