<?php

namespace Tests\Unit\Filament\Student\Resources;

use App\Filament\Student\Resources\UserResource;
use App\Filament\Student\Resources\UserResource\Pages;
use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserResourceTest extends TestCase
{
    /** @test */
    public function it_has_the_correct_model()
    {
        $this->assertEquals(User::class, UserResource::getModel());
    }

    /** @test */
    public function it_has_the_correct_navigation_icon()
    {
        $this->assertEquals('heroicon-o-user', UserResource::getNavigationIcon());
    }

    /** @test */
    public function it_has_the_correct_active_navigation_icon()
    {
        $this->assertEquals('heroicon-s-user', UserResource::getActiveNavigationIcon());
    }

    /** @test */
    public function it_should_not_register_navigation()
    {
        $this->assertFalse(UserResource::shouldRegisterNavigation());
    }

    /** @test */
    public function it_has_the_correct_navigation_group()
    {
        $this->assertEquals('Profile', UserResource::getNavigationGroup());
    }

    /** @test */
    public function it_returns_the_correct_relations()
    {
        $relations = UserResource::getRelations();

        $this->assertCount(0, $relations);
    }

    /** @test */
    public function it_returns_the_correct_pages()
    {
        $pages = UserResource::getPages();

        $this->assertArrayHasKey('index', $pages);
        $this->assertArrayHasKey('create', $pages);
        $this->assertArrayHasKey('edit', $pages);

        $this->assertEquals(Pages\ListUsers::route('/'), $pages['index']);
        $this->assertEquals(Pages\CreateUser::route('/create'), $pages['create']);
        $this->assertEquals(Pages\EditUser::route('/{record}/edit'), $pages['edit']);
    }
}
