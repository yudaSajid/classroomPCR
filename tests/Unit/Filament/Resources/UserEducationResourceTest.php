<?php

namespace Tests\Unit\Filament\Resources;

use App\Filament\Resources\UserEducationResource;
use App\Filament\Resources\UserEducationResource\Pages;
use App\Models\UserEducation;
use PHPUnit\Framework\TestCase;

class UserEducationResourceTest extends TestCase
{
    /** @test */
    public function it_has_the_correct_model()
    {
        $this->assertEquals(UserEducation::class, UserEducationResource::getModel());
    }

    /** @test */
    public function it_has_the_correct_navigation_icon()
    {
        $this->assertEquals('heroicon-o-identification', UserEducationResource::getNavigationIcon());
    }

    /** @test */
    public function it_has_the_correct_navigation_group()
    {
        $this->assertEquals('User Management', UserEducationResource::getNavigationGroup());
    }

    /** @test */
    public function it_has_the_correct_navigation_parent_item()
    {
        $this->assertEquals('Users', UserEducationResource::getNavigationParentItem());
    }

    /** @test */
    public function it_returns_the_correct_relations()
    {
        $relations = UserEducationResource::getRelations();

        $this->assertCount(0, $relations);
    }

    /** @test */
    public function it_returns_the_correct_pages()
    {
        $pages = UserEducationResource::getPages();

        $this->assertArrayHasKey('index', $pages);
        $this->assertArrayHasKey('create', $pages);
        $this->assertArrayHasKey('edit', $pages);

        $this->assertEquals(Pages\ListUserEducation::route('/'), $pages['index']);
        $this->assertEquals(Pages\CreateUserEducation::route('/create'), $pages['create']);
        $this->assertEquals(Pages\EditUserEducation::route('/{record}/edit'), $pages['edit']);
    }
}
