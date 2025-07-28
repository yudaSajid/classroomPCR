<?php

namespace Tests\Unit\Filament\Resources;

use App\Filament\Resources\SemesterResource;
use App\Filament\Resources\SemesterResource\Pages;
use App\Models\Semester;
use PHPUnit\Framework\TestCase;

class SemesterResourceTest extends TestCase
{
    /** @test */
    public function it_has_the_correct_model()
    {
        $this->assertEquals(Semester::class, SemesterResource::getModel());
    }

    /** @test */
    public function it_has_the_correct_navigation_icon()
    {
        $this->assertEquals('heroicon-o-calendar-days', SemesterResource::getNavigationIcon());
    }

    /** @test */
    public function it_has_the_correct_navigation_group()
    {
        $this->assertEquals('Education Management', SemesterResource::getNavigationGroup());
    }

    /** @test */
    public function it_has_the_correct_navigation_parent_item()
    {
        $this->assertEquals('Periods', SemesterResource::getNavigationParentItem());
    }

    /** @test */
    public function it_returns_the_correct_relations()
    {
        $relations = SemesterResource::getRelations();

        $this->assertCount(0, $relations);
    }

    /** @test */
    public function it_returns_the_correct_pages()
    {
        $pages = SemesterResource::getPages();

        $this->assertArrayHasKey('index', $pages);
        $this->assertArrayHasKey('create', $pages);
        $this->assertArrayHasKey('edit', $pages);

        $this->assertEquals(Pages\ListSemesters::route('/'), $pages['index']);
        $this->assertEquals(Pages\CreateSemester::route('/create'), $pages['create']);
        $this->assertEquals(Pages\EditSemester::route('/{record}/edit'), $pages['edit']);
    }
}
