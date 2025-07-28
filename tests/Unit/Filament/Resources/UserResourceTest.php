<?php

namespace Tests\Unit\Filament\Resources;

use App\Filament\Resources\UserResource;
use App\Filament\Resources\UserResource\Pages;
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
        $this->assertEquals('heroicon-o-user-group', UserResource::getNavigationIcon());
    }

    /** @test */
    public function it_has_the_correct_navigation_group()
    {
        $this->assertEquals('User Management', UserResource::getNavigationGroup());
    }

    /** @test */
    public function it_has_the_correct_record_title_attribute()
    {
        $this->assertEquals('name', UserResource::getRecordTitleAttribute());
    }

    /** @test */
    public function it_returns_the_correct_global_search_result_title()
    {
        $user = new User();
        $user->name = 'Test User';

        $this->assertEquals('Test User', UserResource::getGlobalSearchResultTitle($user));
    }

    /** @test */
    public function it_returns_the_correct_global_search_result_details()
    {
        $user = new User();
        $user->email = 'test@example.com';

        $this->assertEquals([
            'Email' => 'test@example.com',
        ], UserResource::getGlobalSearchResultDetails($user));
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
