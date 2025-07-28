<?php

namespace Tests\Unit\Filament\Resources;

use App\Filament\Resources\AssignmentResource;
use App\Filament\Resources\AssignmentResource\Pages;
use App\Models\Assignment;
use PHPUnit\Framework\TestCase;

class AssignmentResourceTest extends TestCase
{
    /** @test */
    public function it_has_the_correct_model()
    {
        $this->assertEquals(Assignment::class, AssignmentResource::getModel());
    }

    /** @test */
    public function it_has_the_correct_navigation_icon()
    {
        $this->assertEquals('heroicon-o-book-open', AssignmentResource::getNavigationIcon());
    }

    /** @test */
    public function it_has_the_correct_navigation_group()
    {
        $this->assertEquals('Course Management', AssignmentResource::getNavigationGroup());
    }

    /** @test */
    public function it_has_the_correct_navigation_parent_item()
    {
        $this->assertEquals('Courses', AssignmentResource::getNavigationParentItem());
    }

    /** @test */
    public function it_has_the_correct_navigation_label()
    {
        $this->assertEquals('Assignment', AssignmentResource::getNavigationLabel());
    }

    /** @test */
    public function it_returns_the_correct_pages()
    {
        $pages = AssignmentResource::getPages();

        $this->assertArrayHasKey('index', $pages);
        $this->assertArrayHasKey('create', $pages);
        $this->assertArrayHasKey('edit', $pages);

        $this->assertEquals(Pages\ListAssignments::route('/'), $pages['index']);
        $this->assertEquals(Pages\CreateAssignment::route('/create'), $pages['create']);
        $this->assertEquals(Pages\EditAssignment::route('/{record}/edit'), $pages['edit']);
    }
}