<?php

namespace Tests\Unit\Filament\Resources;

use App\Filament\Resources\ProjectResource;
use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use PHPUnit\Framework\TestCase;

class ProjectResourceTest extends TestCase
{
    /** @test */
    public function it_has_the_correct_model()
    {
        $this->assertEquals(Project::class, ProjectResource::getModel());
    }

    /** @test */
    public function it_has_the_correct_navigation_group()
    {
        $this->assertEquals('Course Management', ProjectResource::getNavigationGroup());
    }

    /** @test */
    public function it_has_the_correct_navigation_parent_item()
    {
        $this->assertEquals('Courses', ProjectResource::getNavigationParentItem());
    }

    /** @test */
    public function it_returns_the_correct_relations()
    {
        $relations = ProjectResource::getRelations();

        $this->assertCount(0, $relations);
    }

    /** @test */
    public function it_returns_the_correct_pages()
    {
        $pages = ProjectResource::getPages();

        $this->assertArrayHasKey('index', $pages);
        $this->assertArrayNotHasKey('create', $pages);
        $this->assertArrayNotHasKey('edit', $pages);

        $this->assertEquals(Pages\ListProjects::route('/'), $pages['index']);
    }
}
