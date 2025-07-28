<?php

namespace Tests\Unit\Filament\Resources;

use App\Filament\Resources\UserInformationResource;
use App\Filament\Resources\UserInformationResource\Pages;
use App\Models\UserInformation;
use PHPUnit\Framework\TestCase;

class UserInformationResourceTest extends TestCase
{
    /** @test */
    public function it_has_the_correct_model()
    {
        $this->assertEquals(UserInformation::class, UserInformationResource::getModel());
    }

    /** @test */
    public function it_has_the_correct_navigation_icon()
    {
        $this->assertEquals('heroicon-o-identification', UserInformationResource::getNavigationIcon());
    }

    /** @test */
    public function it_has_the_correct_navigation_group()
    {
        $this->assertEquals('User Management', UserInformationResource::getNavigationGroup());
    }

    /** @test */
    public function it_has_the_correct_navigation_parent_item()
    {
        $this->assertEquals('Users', UserInformationResource::getNavigationParentItem());
    }

    /** @test */
    public function it_returns_the_correct_relations()
    {
        $relations = UserInformationResource::getRelations();

        $this->assertCount(0, $relations);
    }

    /** @test */
    public function it_returns_the_correct_pages()
    {
        $pages = UserInformationResource::getPages();

        $this->assertArrayHasKey('index', $pages);
        $this->assertArrayHasKey('create', $pages);
        $this->assertArrayHasKey('edit', $pages);

        $this->assertEquals(Pages\ListUserInformation::route('/'), $pages['index']);
        $this->assertEquals(Pages\CreateUserInformation::route('/create'), $pages['create']);
        $this->assertEquals(Pages\EditUserInformation::route('/{record}/edit'), $pages['edit']);
    }
}
