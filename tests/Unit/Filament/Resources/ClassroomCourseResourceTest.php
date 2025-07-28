<?php

namespace Tests\Unit\Filament\Resources;

use App\Filament\Resources\ClassroomCourseResource;
use App\Filament\Resources\ClassroomCourseResource\Pages;
use App\Models\ClassroomCourse;
use PHPUnit\Framework\TestCase;

class ClassroomCourseResourceTest extends TestCase
{
    /** @test */
    public function it_has_the_correct_model()
    {
        $this->assertEquals(ClassroomCourse::class, ClassroomCourseResource::getModel());
    }

    /** @test */
    public function it_has_the_correct_navigation_icon()
    {
        $this->assertEquals('heroicon-o-rectangle-stack', ClassroomCourseResource::getNavigationIcon());
    }

    /** @test */
    public function it_has_the_correct_navigation_group()
    {
        $this->assertEquals('Classroom Management', ClassroomCourseResource::getNavigationGroup());
    }

    /** @test */
    public function it_has_the_correct_navigation_parent_item()
    {
        $this->assertEquals('Classrooms', ClassroomCourseResource::getNavigationParentItem());
    }

    /** @test */
    public function it_returns_the_correct_relations()
    {
        $relations = ClassroomCourseResource::getRelations();

        $this->assertCount(0, $relations);
    }

    /** @test */
    public function it_returns_the_correct_pages()
    {
        $pages = ClassroomCourseResource::getPages();

        $this->assertArrayHasKey('index', $pages);
        $this->assertArrayHasKey('create', $pages);
        $this->assertArrayHasKey('edit', $pages);

        $this->assertEquals(Pages\ListClassroomCourses::route('/'), $pages['index']);
        $this->assertEquals(Pages\CreateClassroomCourse::route('/create'), $pages['create']);
        $this->assertEquals(Pages\EditClassroomCourse::route('/{record}/edit'), $pages['edit']);
    }
}
