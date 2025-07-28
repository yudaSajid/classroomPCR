<?php

namespace Tests\Unit\Filament\Resources;

use App\Filament\Resources\TaskResource;
use App\Filament\Resources\TaskResource\Pages;
use App\Models\Task;
use PHPUnit\Framework\TestCase;

class TaskResourceTest extends TestCase
{
    /** @test */
    public function it_has_the_correct_model()
    {
        $this->assertEquals(Task::class, TaskResource::getModel());
    }

    /** @test */
    public function it_has_the_correct_navigation_icon()
    {
        $this->assertEquals('heroicon-o-code-bracket-square', TaskResource::getNavigationIcon());
    }

    /** @test */
    public function it_has_the_correct_navigation_group()
    {
        $this->assertEquals('Course Management', TaskResource::getNavigationGroup());
    }

    /** @test */
    public function it_has_the_correct_navigation_parent_item()
    {
        $this->assertEquals('Challenges', TaskResource::getNavigationParentItem());
    }

    /** @test */
    public function it_returns_the_correct_relations()
    {
        $relations = TaskResource::getRelations();

        $this->assertCount(0, $relations);
    }

    /** @test */
    public function it_returns_the_correct_pages()
    {
        $pages = TaskResource::getPages();

        $this->assertArrayHasKey('index', $pages);
        $this->assertArrayHasKey('create', $pages);
        $this->assertArrayHasKey('edit', $pages);

        $this->assertEquals(Pages\ListTasks::route('/'), $pages['index']);
        $this->assertEquals(Pages\CreateTask::route('/create'), $pages['create']);
        $this->assertEquals(Pages\EditTask::route('/{record}/edit'), $pages['edit']);
    }
}
