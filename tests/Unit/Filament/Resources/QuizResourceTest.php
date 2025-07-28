<?php

namespace Tests\Unit\Filament\Resources;

use App\Filament\Resources\QuizResource;
use App\Filament\Resources\QuizResource\Pages;
use App\Filament\Resources\QuizResource\RelationManagers\QuestionsRelationManager;
use App\Models\Quiz;
use PHPUnit\Framework\TestCase;

class QuizResourceTest extends TestCase
{
    /** @test */
    public function it_has_the_correct_model()
    {
        $this->assertEquals(Quiz::class, QuizResource::getModel());
    }

    /** @test */
    public function it_has_the_correct_navigation_icon()
    {
        $this->assertEquals('heroicon-o-puzzle-piece', QuizResource::getNavigationIcon());
    }

    /** @test */
    public function it_has_the_correct_active_navigation_icon()
    {
        $this->assertEquals('heroicon-s-puzzle-piece', QuizResource::getActiveNavigationIcon());
    }

    /** @test */
    public function it_has_the_correct_navigation_group()
    {
        $this->assertEquals('Course Management', QuizResource::getNavigationGroup());
    }

    /** @test */
    public function it_has_the_correct_navigation_parent_item()
    {
        $this->assertEquals('Courses', QuizResource::getNavigationParentItem());
    }

    /** @test */
    public function it_has_the_correct_navigation_sort()
    {
        $this->assertEquals(1, QuizResource::getNavigationSort());
    }

    /** @test */
    public function it_returns_the_correct_relations()
    {
        $relations = QuizResource::getRelations();

        $this->assertCount(1, $relations);
        $this->assertEquals(QuestionsRelationManager::class, $relations[0]);
    }

    /** @test */
    public function it_returns_the_correct_pages()
    {
        $pages = QuizResource::getPages();

        $this->assertArrayHasKey('index', $pages);
        $this->assertArrayHasKey('create', $pages);
        $this->assertArrayHasKey('edit', $pages);

        $this->assertEquals(Pages\ListQuizzes::route('/'), $pages['index']);
        $this->assertEquals(Pages\CreateQuiz::route('/create'), $pages['create']);
        $this->assertEquals(Pages\EditQuiz::route('/{record}/edit'), $pages['edit']);
    }
}
