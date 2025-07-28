<?php

namespace Tests\Unit\Filament\Teacher\Resources;

use App\Filament\Teacher\Resources\ChapterResource;
use App\Filament\Teacher\Resources\ChapterResource\Pages;
use App\Filament\Teacher\Resources\ChapterResource\RelationManagers\AssignmentsRelationManager;
use App\Filament\Teacher\Resources\ChapterResource\RelationManagers\MaterialsRelationManager;
use App\Filament\Teacher\Resources\ChapterResource\RelationManagers\QuizzesRelationManager;
use App\Models\Chapter;
use PHPUnit\Framework\TestCase;

class ChapterResourceTest extends TestCase
{
    /** @test */
    public function it_has_the_correct_model()
    {
        $this->assertEquals(Chapter::class, ChapterResource::getModel());
    }

    /** @test */
    public function it_has_the_correct_navigation_icon()
    {
        $this->assertEquals('heroicon-o-rectangle-stack', ChapterResource::getNavigationIcon());
    }

    /** @test */
    public function it_should_not_register_navigation()
    {
        $this->assertFalse(ChapterResource::shouldRegisterNavigation());
    }

    /** @test */
    public function it_returns_the_correct_relations()
    {
        $relations = ChapterResource::getRelations();

        $this->assertCount(3, $relations);
        $this->assertEquals(MaterialsRelationManager::class, $relations[0]);
        $this->assertEquals(AssignmentsRelationManager::class, $relations[1]);
        $this->assertEquals(QuizzesRelationManager::class, $relations[2]);
    }

    /** @test */
    public function it_returns_the_correct_pages()
    {
        $pages = ChapterResource::getPages();

        $this->assertArrayHasKey('index', $pages);
        $this->assertArrayHasKey('create', $pages);
        $this->assertArrayHasKey('view', $pages);
        $this->assertArrayHasKey('edit', $pages);

        $this->assertEquals(Pages\ListChapters::route('/'), $pages['index']);
        $this->assertEquals(Pages\CreateChapter::route('/create'), $pages['create']);
        $this->assertEquals(Pages\ViewChapter::route('/{record}'), $pages['view']);
        $this->assertEquals(Pages\EditChapter::route('/{record}/edit'), $pages['edit']);
    }
}
