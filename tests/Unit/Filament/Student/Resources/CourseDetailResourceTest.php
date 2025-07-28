<?php

namespace Tests\Unit\Filament\Student\Resources;

use App\Filament\Student\Resources\CourseDetailResource;
use App\Filament\Student\Resources\CourseDetailResource\Pages;
use App\Models\Course;
use PHPUnit\Framework\TestCase;

class CourseDetailResourceTest extends TestCase
{
    /** @test */
    public function it_has_the_correct_model()
    {
        $this->assertEquals(Course::class, CourseDetailResource::getModel());
    }

    /** @test */
    public function it_has_the_correct_navigation_icon()
    {
        $this->assertEquals('heroicon-o-rectangle-stack', CourseDetailResource::getNavigationIcon());
    }

    /** @test */
    public function it_should_not_register_navigation()
    {
        $this->assertFalse(CourseDetailResource::shouldRegisterNavigation());
    }

    /** @test */
    public function it_returns_the_correct_relations()
    {
        $relations = CourseDetailResource::getRelations();

        $this->assertCount(0, $relations);
    }

    /** @test */
    public function it_returns_the_correct_pages()
    {
        $pages = CourseDetailResource::getPages();

        $this->assertArrayHasKey('index', $pages);
        $this->assertArrayHasKey('create', $pages);
        $this->assertArrayHasKey('view', $pages);
        $this->assertArrayHasKey('edit', $pages);

        $this->assertEquals(Pages\ListCourseDetails::route('/'), $pages['index']);
        $this->assertEquals(Pages\CreateCourseDetail::route('/create'), $pages['create']);
        $this->assertEquals(Pages\ViewCourseDetail::route('/{record}'), $pages['view']);
        $this->assertEquals(Pages\EditCourseDetail::route('/{record}/edit'), $pages['edit']);
    }
}
