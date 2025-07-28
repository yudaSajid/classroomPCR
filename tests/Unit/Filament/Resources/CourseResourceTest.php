<?php

namespace Tests\Unit\Filament\Resources;

use App\Filament\Resources\CourseResource;
use App\Filament\Resources\CourseResource\Pages;
use App\Filament\Resources\CourseResource\RelationManagers\ChaptersRelationManager;
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
    public function it_has_the_correct_active_navigation_icon()
    {
        $this->assertEquals('heroicon-s-book-open', CourseResource::getActiveNavigationIcon());
    }

    /** @test */
    public function it_has_the_correct_navigation_group()
    {
        $this->assertEquals('Course Management', CourseResource::getNavigationGroup());
    }

    /** @test */
    public function it_has_the_correct_record_title_attribute()
    {
        $this->assertEquals('course_name', CourseResource::getRecordTitleAttribute());
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

        $this->assertCount(1, $relations);
        $this->assertEquals(ChaptersRelationManager::class, $relations[0]);
    }

    /** @test */
    public function it_returns_the_correct_pages()
    {
        $pages = CourseResource::getPages();

        $this->assertArrayHasKey('index', $pages);
        $this->assertArrayHasKey('create', $pages);
        $this->assertArrayHasKey('edit', $pages);

        $this->assertEquals(Pages\ListCourses::route('/'), $pages['index']);
        $this->assertEquals(Pages\CreateCourse::route('/create'), $pages['create']);
        $this->assertEquals(Pages\EditCourse::route('/{record}/edit'), $pages['edit']);
    }
}
