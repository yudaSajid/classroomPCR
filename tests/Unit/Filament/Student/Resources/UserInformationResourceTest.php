<?php

namespace Tests\Unit\Filament\Student\Resources;

use App\Filament\Student\Resources\UserInformationResource;
use App\Filament\Student\Resources\UserInformationResource\Pages;
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
    public function it_should_not_register_navigation()
    {
        $this->assertFalse(UserInformationResource::shouldRegisterNavigation());
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
