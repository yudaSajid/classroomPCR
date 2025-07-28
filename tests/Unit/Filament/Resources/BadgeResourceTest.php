<?php

namespace Tests\Unit\Filament\Resources;

use App\Filament\Resources\BadgeResource;
use App\Filament\Resources\BadgeResource\Pages;
use App\Filament\Resources\BadgeResource\RelationManagers\UsersRelationManager;
use App\Models\Badge;
use PHPUnit\Framework\TestCase;

class BadgeResourceTest extends TestCase
{
    /** @test */
    public function it_has_the_correct_model()
    {
        $this->assertEquals(Badge::class, BadgeResource::getModel());
    }

    /** @test */
    public function it_has_the_correct_navigation_icon()
    {
        $this->assertEquals('heroicon-o-check-badge', BadgeResource::getNavigationIcon());
    }

    /** @test */
    public function it_has_the_correct_active_navigation_icon()
    {
        $this->assertEquals('heroicon-s-check-badge', BadgeResource::getActiveNavigationIcon());
    }

    /** @test */
    public function it_has_the_correct_navigation_group()
    {
        $this->assertEquals('Achievement', BadgeResource::getNavigationGroup());
    }

    /** @test */
    public function it_returns_the_correct_relations()
    {
        $relations = BadgeResource::getRelations();

        $this->assertCount(1, $relations);
        $this->assertEquals(UsersRelationManager::class, $relations[0]);
    }

    /** @test */
    public function it_returns_the_correct_pages()
    {
        $pages = BadgeResource::getPages();

        $this->assertArrayHasKey('index', $pages);
        $this->assertArrayHasKey('create', $pages);
        $this->assertArrayHasKey('edit', $pages);

        $this->assertEquals(Pages\ListBadges::route('/'), $pages['index']);
        $this->assertEquals(Pages\CreateBadge::route('/create'), $pages['create']);
        $this->assertEquals(Pages\EditBadge::route('/{record}/edit'), $pages['edit']);
    }
}
