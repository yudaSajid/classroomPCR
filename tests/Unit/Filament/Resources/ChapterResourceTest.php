<?php

namespace Tests\Unit\Filament\Resources;

use App\Filament\Resources\ChapterResource;
use App\Filament\Resources\ChapterResource\Pages;
use App\Filament\Resources\ChapterResource\RelationManagers\AssignmentsRelationManager;
use App\Filament\Resources\ChapterResource\RelationManagers\MaterialsRelationManager;
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
        $this->assertEquals('heroicon-o-book-open', ChapterResource::getNavigationIcon());
    }

    /** @test */
    public function it_has_the_correct_navigation_group()
    {
        $this->assertEquals('Course Management', ChapterResource::getNavigationGroup());
    }

    /** @test */
    public function it_has_the_correct_navigation_parent_item()
    {
        $this->assertEquals('Courses', ChapterResource::getNavigationParentItem());
    }

    /** @test */
    public function it_returns_the_correct_relations()
    {
        $relations = ChapterResource::getRelations();

        $this->assertCount(2, $relations);
        $this->assertEquals(MaterialsRelationManager::class, $relations[0]);
        $this->assertEquals(AssignmentsRelationManager::class, $relations[1]);
    }

    /** @test */
    public function it_returns_the_correct_pages()
    {
        $pages = ChapterResource::getPages();

        $this->assertArrayHasKey('index', $pages);
        $this->assertArrayHasKey('create', $pages);
        $this->assertArrayHasKey('edit', $pages);

        $this->assertEquals(Pages\ListChapters::route('/'), $pages['index']);
        $this->assertEquals(Pages\CreateChapter::route('/create'), $pages['create']);
        $this->assertEquals(Pages\EditChapter::route('/{record}/edit'), $pages['edit']);
    }
}
