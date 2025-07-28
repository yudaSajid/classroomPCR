<?php

namespace Tests\Unit\Filament\Resources;

use App\Filament\Resources\ClassroomResource;
use App\Filament\Resources\ClassroomResource\Pages;
use App\Filament\Resources\ClassroomResource\RelationManagers\TeachersRelationManager;
use App\Filament\Resources\ClassroomResource\RelationManagers\UsersRelationManager;
use App\Models\Classroom;
use PHPUnit\Framework\TestCase;

class ClassroomResourceTest extends TestCase
{
    /** @test */
    public function it_has_the_correct_model()
    {
        $this->assertEquals(Classroom::class, ClassroomResource::getModel());
    }

    /** @test */
    public function it_has_the_correct_navigation_icon()
    {
        $this->assertEquals('heroicon-o-academic-cap', ClassroomResource::getNavigationIcon());
    }

    /** @test */
    public function it_has_the_correct_active_navigation_icon()
    {
        $this->assertEquals('heroicon-s-academic-cap', ClassroomResource::getActiveNavigationIcon());
    }

    /** @test */
    public function it_has_the_correct_navigation_label()
    {
        $this->assertEquals('Classrooms', ClassroomResource::getNavigationLabel());
    }

    /** @test */
    public function it_has_the_correct_plural_label()
    {
        $this->assertEquals('Classrooms', ClassroomResource::getPluralLabel());
    }

    /** @test */
    public function it_has_the_correct_navigation_group()
    {
        $this->assertEquals('Classroom Management', ClassroomResource::getNavigationGroup());
    }

    /** @test */
    public function it_returns_the_correct_relations()
    {
        $relations = ClassroomResource::getRelations();

        $this->assertCount(2, $relations);
        $this->assertEquals(UsersRelationManager::class, $relations[0]);
        $this->assertEquals(TeachersRelationManager::class, $relations[1]);
    }

    /** @test */
    public function it_returns_the_correct_pages()
    {
        $pages = ClassroomResource::getPages();

        $this->assertArrayHasKey('index', $pages);
        $this->assertArrayHasKey('create', $pages);
        $this->assertArrayHasKey('edit', $pages);

        $this->assertEquals(Pages\ListClassrooms::route('/'), $pages['index']);
        $this->assertEquals(Pages\CreateClassroom::route('/create'), $pages['create']);
        $this->assertEquals(Pages\EditClassroom::route('/{record}/edit'), $pages['edit']);
    }
}
