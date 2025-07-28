<?php

namespace Tests\Unit\Filament\Teacher\Resources;

use App\Filament\Teacher\Resources\AssignmentResource;
use App\Filament\Teacher\Resources\AssignmentResource\Pages;
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
        $this->assertEquals('heroicon-o-rectangle-stack', AssignmentResource::getNavigationIcon());
    }

    /** @test */
    public function it_should_not_register_navigation()
    {
        $this->assertFalse(AssignmentResource::shouldRegisterNavigation());
    }

    /** @test */
    public function it_returns_the_correct_relations()
    {
        $relations = AssignmentResource::getRelations();

        $this->assertCount(0, $relations);
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
