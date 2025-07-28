<?php

namespace Tests\Unit\Filament\Teacher\Resources;

use App\Filament\Teacher\Resources\CourseResource;
use App\Filament\Teacher\Resources\CourseResource\Pages;
use App\Models\Course;
use PHPUnit\Framework\TestCase;

class CourseResourceTest extends TestCase
{
    /** @test */
    public function it_has_the_correct_model()
    {
        $this->assertEquals(Course::class, CourseResource::getModel());
    }

    /** @test */
    public function it_has_the_correct_navigation_icon()
    {
        $this->assertEquals('heroicon-o-book-open', CourseResource::getNavigationIcon());
    }

    /** @test */
    public function it_should_not_register_navigation()
    {
        $this->assertFalse(CourseResource::shouldRegisterNavigation());
    }

    /** @test */
    public function it_returns_the_correct_global_search_result_title()
    {
        $course = new Course();
        $course->course_name = 'Test Course';

        $this->assertEquals('Test Course', CourseResource::getGlobalSearchResultTitle($course));
    }

    /** @test */
    public function it_returns_the_correct_global_search_result_details()
    {
        $course = new Course();
        $course->course_name = 'Test Course';

        $this->assertEquals([
            'Course' => 'Test Course',
        ], CourseResource::getGlobalSearchResultDetails($course));
    }

    /** @test */
    public function it_returns_the_correct_relations()
    {
        $relations = CourseResource::getRelations();

        $this->assertCount(0, $relations);
    }

    /** @test */
    public function it_returns_the_correct_pages()
    {
        $pages = CourseResource::getPages();

        $this->assertArrayHasKey('index', $pages);
        $this->assertArrayHasKey('create', $pages);
        $this->assertArrayHasKey('view', $pages);
        $this->assertArrayHasKey('edit', $pages);

        $this->assertEquals(Pages\ListCourses::route('/'), $pages['index']);
        $this->assertEquals(Pages\CreateCourse::route('/create'), $pages['create']);
        $this->assertEquals(Pages\ViewCourse::route('/{record}'), $pages['view']);
        $this->assertEquals(Pages\EditCourse::route('/{record}/edit'), $pages['edit']);
    }
}
