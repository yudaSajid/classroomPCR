<?php

namespace Tests\Unit\Filament\Resources;

use App\Filament\Resources\DepartmentResource;
use App\Filament\Resources\DepartmentResource\Pages;
use App\Filament\Resources\ProgramsResource\RelationManagers\ProgramNameRelationManager;
use App\Models\Department;
use PHPUnit\Framework\TestCase;

class DepartmentResourceTest extends TestCase
{
    /** @test */
    public function it_has_the_correct_model()
    {
        $this->assertEquals(Department::class, DepartmentResource::getModel());
    }

    /** @test */
    public function it_has_the_correct_navigation_icon()
    {
        $this->assertEquals('heroicon-o-rectangle-stack', DepartmentResource::getNavigationIcon());
    }

    /** @test */
    public function it_has_the_correct_active_navigation_icon()
    {
        $this->assertEquals('heroicon-s-rectangle-stack', DepartmentResource::getActiveNavigationIcon());
    }

    /** @test */
    public function it_has_the_correct_navigation_group()
    {
        $this->assertEquals('Education Management', DepartmentResource::getNavigationGroup());
    }

    /** @test */
    public function it_returns_the_correct_relations()
    {
        $relations = DepartmentResource::getRelations();

        $this->assertCount(1, $relations);
        $this->assertEquals(ProgramNameRelationManager::class, $relations[0]);
    }

    /** @test */
    public function it_returns_the_correct_pages()
    {
        $pages = DepartmentResource::getPages();

        $this->assertArrayHasKey('index', $pages);
        $this->assertArrayHasKey('create', $pages);
        $this->assertArrayHasKey('edit', $pages);

        $this->assertEquals(Pages\ListDepartments::route('/'), $pages['index']);
        $this->assertEquals(Pages\CreateDepartment::route('/create'), $pages['create']);
        $this->assertEquals(Pages\EditDepartment::route('/{record}/edit'), $pages['edit']);
    }
}
