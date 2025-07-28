<?php

namespace Tests\Unit\Filament\Resources;

use App\Filament\Resources\QuestionResource;
use App\Filament\Resources\QuestionResource\Pages;
use App\Models\Question;
use PHPUnit\Framework\TestCase;

class QuestionResourceTest extends TestCase
{
    /** @test */
    public function it_has_the_correct_model()
    {
        $this->assertEquals(Question::class, QuestionResource::getModel());
    }

    /** @test */
    public function it_has_the_correct_navigation_icon()
    {
        $this->assertEquals('heroicon-o-question-mark-circle', QuestionResource::getNavigationIcon());
    }

    /** @test */
    public function it_does_not_register_navigation()
    {
        $this->assertFalse(QuestionResource::shouldRegisterNavigation());
    }

    /** @test */
    public function it_returns_the_correct_relations()
    {
        $relations = QuestionResource::getRelations();

        $this->assertCount(0, $relations);
    }

    /** @test */
    public function it_returns_the_correct_pages()
    {
        $pages = QuestionResource::getPages();

        $this->assertArrayHasKey('index', $pages);
        $this->assertArrayHasKey('create', $pages);
        $this->assertArrayHasKey('edit', $pages);

        $this->assertEquals(Pages\ListQuestions::route('/'), $pages['index']);
        $this->assertEquals(Pages\CreateQuestion::route('/create'), $pages['create']);
        $this->assertEquals(Pages\EditQuestion::route('/{record}/edit'), $pages['edit']);
    }
}
